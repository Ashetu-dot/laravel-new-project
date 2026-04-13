<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please login to checkout.');
            }

            // Get cart items
            $cartItems = Cart::where('user_id', $user->id)
                ->with(['product', 'product.vendor'])
                ->get();

            if ($cartItems->isEmpty()) {
                return redirect()->route('customer.cart.index')->with('error', 'Your cart is empty.');
            }

            // Validate stock for all items
            foreach ($cartItems as $item) {
                if (!$item->product) {
                    return redirect()->route('customer.cart.index')
                        ->with('error', 'Some products in your cart are no longer available.');
                }
                
                if ($item->product->stock < $item->quantity) {
                    return redirect()->route('customer.cart.index')
                        ->with('error', "Insufficient stock for {$item->product->name}. Only {$item->product->stock} available.");
                }
            }

            // Calculate totals
            $subtotal = $cartItems->sum(function($item) {
                return $item->product->price * $item->quantity;
            });

            $tax = $subtotal * 0.15; // 15% VAT
            $shippingFee = 50; // Fixed shipping fee in ETB
            $total = $subtotal + $tax + $shippingFee;

            // Get user's saved addresses
            $savedAddresses = [
                'shipping' => $user->address ?? '',
                'city' => $user->city ?? '',
                'state' => $user->state ?? '',
                'phone' => $user->phone ?? '',
            ];

            return view('customer.checkout.index', compact(
                'cartItems',
                'subtotal',
                'tax',
                'shippingFee',
                'total',
                'savedAddresses'
            ));

        } catch (\Exception $e) {
            Log::error('Checkout index error: ' . $e->getMessage());
            return redirect()->route('customer.cart.index')->with('error', 'Failed to load checkout page.');
        }
    }

    /**
     * Process the checkout and create order.
     */
    public function process(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Please login first'], 401);
            }

            // Validate request
            $validated = $request->validate([
                'payment_method' => 'required|in:cash_on_delivery,chapa',
                'shipping_address' => 'required|string|max:500',
                'shipping_city' => 'required|string|max:100',
                'shipping_state' => 'required|string|max:100',
                'phone' => 'required|string|max:20',
                'notes' => 'nullable|string|max:1000',
            ]);

            // Get cart items
            $cartItems = Cart::where('user_id', $user->id)
                ->with(['product', 'product.vendor'])
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['success' => false, 'message' => 'Your cart is empty'], 400);
            }

            // Start transaction
            DB::beginTransaction();

            try {
                // Group cart items by vendor
                $itemsByVendor = $cartItems->groupBy('product.vendor_id');

                $createdOrders = [];

                foreach ($itemsByVendor as $vendorId => $items) {
                    // Calculate order total for this vendor
                    $orderSubtotal = $items->sum(function($item) {
                        return $item->product->price * $item->quantity;
                    });

                    $orderTax = $orderSubtotal * 0.15;
                    $orderShipping = 50; // Fixed per vendor
                    $orderTotal = $orderSubtotal + $orderTax + $orderShipping;

                    // Generate unique order number
                    $orderNumber = 'ORD-' . strtoupper(uniqid());

                    // Create shipping address string
                    $shippingAddress = $validated['shipping_address'] . ', ' . 
                                     $validated['shipping_city'] . ', ' . 
                                     $validated['shipping_state'] . ' | Phone: ' . 
                                     $validated['phone'];

                    // Create order
                    $order = Order::create([
                        'order_number' => $orderNumber,
                        'user_id' => $user->id,
                        'vendor_id' => $vendorId,
                        'total_amount' => $orderTotal,
                        'status' => 'pending',
                        'payment_method' => $validated['payment_method'],
                        'payment_status' => 'pending',
                        'shipping_address' => $shippingAddress,
                        'billing_address' => $shippingAddress,
                        'notes' => $validated['notes'] ?? null,
                    ]);

                    // Create order items and update stock
                    foreach ($items as $cartItem) {
                        $product = $cartItem->product;

                        // Check stock again
                        if ($product->stock < $cartItem->quantity) {
                            throw new \Exception("Insufficient stock for {$product->name}");
                        }

                        // Create order item
                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $product->id,
                            'vendor_id' => $vendorId,
                            'quantity' => $cartItem->quantity,
                            'price' => $product->price,
                            'total' => $product->price * $cartItem->quantity,
                        ]);

                        // Decrease product stock
                        $product->decrement('stock', $cartItem->quantity);
                        $product->increment('sold_count', $cartItem->quantity);
                    }

                    // Notify vendor about new order
                    if ($vendorId) {
                        \App\Models\Notification::create([
                            'user_id' => $vendorId,
                            'type' => 'new_order',
                            'title' => 'New Order Received',
                            'message' => "You have received a new order #{$orderNumber} worth " . number_format($orderTotal) . " ETB",
                            'data' => json_encode([
                                'order_id' => $order->id,
                                'order_number' => $orderNumber,
                                'customer_name' => $user->name,
                                'total_amount' => $orderTotal,
                                'items_count' => $items->count(),
                            ]),
                            'is_read' => false,
                        ]);
                    }

                    $createdOrders[] = $order;
                }

                // Clear cart
                Cart::where('user_id', $user->id)->delete();

                DB::commit();

                // Convert created orders array to collection
                $ordersCollection = collect($createdOrders);

                // If payment method is Chapa, initiate Chapa payment
                if ($validated['payment_method'] === 'chapa') {
                    $chapaUrl = $this->initiateChapaPayment($ordersCollection, $user);
                    if ($chapaUrl) {
                        return response()->json([
                            'success' => true,
                            'redirect' => $chapaUrl,
                            'chapa' => true,
                        ]);
                    }
                    // Fallback if Chapa init fails
                    return response()->json(['success' => false, 'message' => 'Failed to initiate Chapa payment. Please try again.'], 500);
                }

                // Return success with order details
                return response()->json([
                    'success' => true,
                    'message' => 'Order placed successfully!',
                    'orders' => $ordersCollection->map(function($order) {
                        return [
                            'order_number' => $order->order_number,
                            'total' => $order->total_amount,
                        ];
                    }),
                    'redirect' => route('customer.orders.success', ['orders' => implode(',', $ordersCollection->pluck('order_number')->toArray())])
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Please fill in all required fields',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Checkout process error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() ?: 'Failed to process order. Please try again.'
            ], 500);
        }
    }

    /**
     * Display order success page.
     */
    public function success(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login');
            }

            $orderNumbers = explode(',', $request->get('orders', ''));
            
            $orders = Order::whereIn('order_number', $orderNumbers)
                ->where('user_id', $user->id)
                ->with(['items.product', 'vendor'])
                ->get();

            if ($orders->isEmpty()) {
                return redirect()->route('customer.cart.index')->with('error', 'Orders not found.');
            }

            return view('customer.checkout.success', compact('orders'));

        } catch (\Exception $e) {
            Log::error('Order success page error: ' . $e->getMessage());
            return redirect()->route('customer.cart.index')->with('error', 'Failed to load order details.');
        }
    }

    /**
     * Initiate Chapa payment and return checkout URL.
     */
    private function initiateChapaPayment($orders, $user)
    {
        try {
            $totalAmount = $orders->sum('total_amount');
            $txRef       = 'VND-' . time() . '-' . $orders->first()->id;
            $orderNums   = $orders->pluck('order_number')->implode(',');

            // Store tx_ref → order numbers mapping in session for callback
            session(['chapa_tx_ref' => $txRef, 'chapa_orders' => $orderNums]);

            $nameParts = explode(' ', trim($user->name));
            $firstName = $nameParts[0] ?? $user->name;
            $lastName  = $nameParts[1] ?? 'User';

            $payload = [
                'amount'       => number_format($totalAmount, 2, '.', ''),
                'currency'     => 'ETB',
                'email'        => $user->email,
                'first_name'   => $firstName,
                'last_name'    => $lastName,
                'phone_number' => $user->phone ?? '0911000000',
                'tx_ref'       => $txRef,
                'callback_url' => route('customer.checkout.chapa.callback'),
                'return_url'   => route('customer.checkout.chapa.callback') . '?tx_ref=' . $txRef,
                'customization' => [
                    'title'       => 'Vendora Payment',
                    'description' => 'Payment for order(s): ' . $orderNums,
                ],
            ];

            $response = \Illuminate\Support\Facades\Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . env('CHAPA_SECRET_KEY'),
                    'Content-Type'  => 'application/json',
                ])->post(env('CHAPA_BASE_URL', 'https://api.chapa.co/v1') . '/transaction/initialize', $payload);

            $data = $response->json();

            Log::info('Chapa init response', [
                'status'  => $response->status(),
                'body'    => $data,
                'payload' => array_merge($payload, ['email' => '***']),
            ]);

            if ($response->successful() && isset($data['data']['checkout_url'])) {
                return $data['data']['checkout_url'];
            }

            // Return the actual Chapa error message for debugging
            $chapaMessage = $data['message'] ?? 'Unknown error from Chapa';
            Log::error('Chapa init failed (' . $response->status() . '): ' . $chapaMessage);
            throw new \Exception('Chapa: ' . $chapaMessage);

        } catch (\Exception $e) {
            Log::error('Chapa payment error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Handle Chapa payment callback — verify and update order status.
     */
    public function chapaCallback(Request $request)
    {
        try {
            $txRef = $request->get('tx_ref') ?? session('chapa_tx_ref');

            if (!$txRef) {
                return redirect()->route('customer.cart.index')->with('error', 'Payment reference not found.');
            }

            // Verify transaction with Chapa
            $response = \Illuminate\Support\Facades\Http::withoutVerifying()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . env('CHAPA_SECRET_KEY'),
                ])->get(env('CHAPA_BASE_URL', 'https://api.chapa.co/v1') . '/transaction/verify/' . $txRef);

            $data = $response->json();

            if (!$response->successful() || ($data['data']['status'] ?? '') !== 'success') {
                Log::warning('Chapa verification failed: ' . json_encode($data));
                return redirect()->route('customer.cart.index')->with('error', 'Payment verification failed. Please contact support.');
            }

            // Get order numbers from session or tx_ref
            $orderNums = session('chapa_orders', '');
            if (!$orderNums) {
                // Try to extract from tx_ref metadata
                $orderNums = $data['data']['meta']['order_numbers'] ?? '';
            }

            if ($orderNums) {
                $orderNumbers = explode(',', $orderNums);
                Order::whereIn('order_number', $orderNumbers)
                    ->update([
                        'payment_status' => 'paid',
                        'status'         => 'processing',
                    ]);
            }

            // Clear session
            session()->forget(['chapa_tx_ref', 'chapa_orders']);

            return redirect()->route('customer.orders.success', ['orders' => $orderNums])
                ->with('success', 'Payment successful! Your order is being processed.');

        } catch (\Exception $e) {
            Log::error('Chapa callback error: ' . $e->getMessage());
            return redirect()->route('customer.cart.index')->with('error', 'Payment processing error. Please contact support.');
        }
    }
}
