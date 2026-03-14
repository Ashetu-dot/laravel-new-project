<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample vendors
        $vendors = [
            [
                'name' => 'John Doe',
                'business_name' => 'Doe\'s Coffee Shop',
                'email' => 'john@example.com',
                'password' => Hash::make('password'),
                'phone' => '+251911123456',
                'address_line1' => '123 Main Street',
                'city' => 'Jimma',
                'description' => 'Authentic Ethiopian coffee roasted fresh daily. We serve traditional coffee ceremonies and modern espresso drinks.',
                'main_image' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'business_hours' => json_encode([
                    'weekday' => '7:00–20:00',
                    'saturday' => '8:00–21:00',
                    'sunday' => '8:00–18:00',
                ]),
                'role' => 'vendor',
                'is_active' => true,
                'is_verified' => true,
            ],
            [
                'name' => 'Jane Smith',
                'business_name' => 'Smith Handicrafts',
                'email' => 'jane@example.com',
                'password' => Hash::make('password'),
                'phone' => '+251922654321',
                'address_line1' => '456 Artisan Lane',
                'city' => 'Jimma',
                'description' => 'Handmade Ethiopian crafts including traditional baskets, jewelry, and textiles. Each piece tells a story of our rich cultural heritage.',
                'main_image' => 'https://images.unsplash.com/photo-1452860606245-08befc0ff44b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80',
                'business_hours' => json_encode([
                    'weekday' => '9:00–18:00',
                    'saturday' => '10:00–16:00',
                    'sunday' => 'Closed',
                ]),
                'role' => 'vendor',
                'is_active' => true,
                'is_verified' => true,
            ],
        ];

        foreach ($vendors as $vendorData) {
            $vendor = User::updateOrCreate(
                ['email' => $vendorData['email']],
                $vendorData
            );

            // Create sample products for each vendor
            $products = [
                [
                    'name' => 'Ethiopian Coffee Beans',
                    'description' => 'Premium single-origin coffee beans from the highlands of Ethiopia.',
                    'price' => 25.00,
                    'images' => json_encode(['https://images.unsplash.com/photo-1559056199-641a0ac8b55e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80']),
                    'tags' => json_encode(['coffee', 'beans', 'ethiopian']),
                    'is_active' => true,
                ],
                [
                    'name' => 'Handwoven Basket',
                    'description' => 'Traditional Ethiopian handwoven basket made from local grasses.',
                    'price' => 45.00,
                    'images' => json_encode(['https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80']),
                    'tags' => json_encode(['basket', 'handwoven', 'traditional']),
                    'is_active' => true,
                ],
            ];

            foreach ($products as $productData) {
                $product = $vendor->products()->create($productData);

                // Create sample reviews
                $reviews = [
                    [
                        'user_id' => 1, // Assuming admin user exists
                        'rating' => 5,
                        'comment' => 'Excellent quality! Highly recommend.',
                        'is_approved' => true,
                    ],
                    [
                        'user_id' => 1,
                        'rating' => 4,
                        'comment' => 'Great product, fast delivery.',
                        'is_approved' => true,
                    ],
                ];

                foreach ($reviews as $reviewData) {
                    $product->reviews()->create($reviewData);
                }
            }
        }

        $this->command->info('Sample vendors and products created!');
    }
}
