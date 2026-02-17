<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class HomePageDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Clear existing data (optional - comment out if you want to keep existing data)
        $this->clearExistingData();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create admin user
        $this->createAdminUser();
        
        // Create sample customers
        $this->createCustomers();
        
        // Create sample vendors
        $this->createVendors();
        
        // Create categories
        $this->createCategories();
        
        // Create testimonials
        $this->createTestimonials();
        
        // Populate category_vendor pivot table
        $this->populateCategoryVendorPivot();
        
        // Create sample products for vendors
        $this->createProducts();
        
        // Create follower relationships
        $this->createFollowers();
        
        // Update vendor stats
        $this->updateVendorStats();
        
        $this->command->info('====================================');
        $this->command->info('HomePageDataSeeder completed successfully!');
        $this->command->info('====================================');
    }

    /**
     * Clear existing data
     */
    private function clearExistingData(): void
    {
        // Delete in correct order to avoid foreign key constraints
        Product::truncate();
        DB::table('category_vendor')->truncate();
        DB::table('followers')->truncate();
        Testimonial::truncate();
        
        // Delete users with role not admin (optional)
        User::whereIn('role', ['customer', 'vendor'])->delete();
        
        $this->command->info('Existing data cleared');
    }

    /**
     * Create admin user
     */
    private function createAdminUser(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@vendora.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'email_verified_at' => now(),
                'country' => 'Ethiopia',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'phone' => '+251911123456',
                'address_line1' => 'Administration Office',
                'location' => 'Jimma, Oromia, Ethiopia',
            ]
        );
        
        $this->command->info('✓ Admin user created');
    }

    /**
     * Create sample customers
     */
    private function createCustomers(): void
    {
        $customers = [
            [
                'name' => 'Abebe Kebede',
                'email' => 'abebe@example.com',
                'phone' => '+251911234567',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Bosa Addis Ketema',
            ],
            [
                'name' => 'Azeb Tadesse',
                'email' => 'azeb@example.com',
                'phone' => '+251922345678',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Mendera Kochi',
            ],
            [
                'name' => 'Mekdes Alemu',
                'email' => 'mekdes@example.com',
                'phone' => '+251933456789',
                'city' => 'Addis Ababa',
                'state' => 'Addis Ababa',
                'address_line1' => 'Bole',
            ],
            [
                'name' => 'Tekle Berhan',
                'email' => 'tekle@example.com',
                'phone' => '+251944567890',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Hermata',
            ],
            [
                'name' => 'Hana Wondimu',
                'email' => 'hana@example.com',
                'phone' => '+251955678901',
                'city' => 'Bahir Dar',
                'state' => 'Amhara',
                'address_line1' => 'Piazza',
            ],
            [
                'name' => 'Dawit Mekonnen',
                'email' => 'dawit@example.com',
                'phone' => '+251966789012',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Kitfur',
            ],
            [
                'name' => 'Tigist Worku',
                'email' => 'tigist@example.com',
                'phone' => '+251977890123',
                'city' => 'Hawassa',
                'state' => 'Sidama',
                'address_line1' => 'Piassa',
            ],
        ];

        foreach ($customers as $customerData) {
            $location = $customerData['city'] . ', ' . $customerData['state'] . ', Ethiopia';
            
            User::updateOrCreate(
                ['email' => $customerData['email']],
                [
                    'name' => $customerData['name'],
                    'password' => Hash::make('password'),
                    'role' => 'customer',
                    'is_active' => true,
                    'email_verified_at' => now(),
                    'country' => 'Ethiopia',
                    'city' => $customerData['city'],
                    'state' => $customerData['state'],
                    'phone' => $customerData['phone'],
                    'address_line1' => $customerData['address_line1'],
                    'location' => $location,
                ]
            );
        }
        
        $this->command->info('✓ ' . count($customers) . ' customers created');
    }

    /**
     * Create sample vendors
     */
    private function createVendors(): void
    {
        $vendors = [
            [
                'business_name' => 'Jimma Coffee Roasters',
                'name' => 'Tsegaye Mulugeta',
                'email' => 'coffee@jimmavendors.com',
                'category' => 'Coffee & Tea',
                'description' => 'Premium coffee roasters in Jimma, offering the finest Ethiopian coffee beans from local farmers.',
                'phone' => '+251911111111',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Bosa Addis Ketema',
                'rating' => 4.9,
                'total_reviews' => 128,
                'products_count' => 15,
                'website' => 'https://jimmacoffee.com',
                'facebook_url' => 'https://facebook.com/jimmacoffee',
                'instagram_url' => 'https://instagram.com/jimmacoffee',
                'telegram_url' => 'https://t.me/jimmacoffee',
            ],
            [
                'business_name' => 'Ethiopian Handicrafts',
                'name' => 'Meseret Tekle',
                'email' => 'handicrafts@jimmavendors.com',
                'category' => 'Traditional Handicrafts',
                'description' => 'Authentic Ethiopian crafts, baskets, and traditional artworks made by local artisans.',
                'phone' => '+251922222222',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Mendera Kochi',
                'rating' => 4.8,
                'total_reviews' => 95,
                'products_count' => 42,
                'website' => 'https://ethiopianhandicrafts.com',
                'facebook_url' => 'https://facebook.com/ethiopianhandicrafts',
                'instagram_url' => 'https://instagram.com/ethiopianhandicrafts',
            ],
            [
                'business_name' => 'Abebech\'s Kitchen',
                'name' => 'Abebech Wondimu',
                'email' => 'food@jimmavendors.com',
                'category' => 'Ethiopian Food',
                'description' => 'Traditional Ethiopian cuisine, injera, wot, and catering services for events.',
                'phone' => '+251933333333',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Hermata',
                'rating' => 4.7,
                'total_reviews' => 156,
                'products_count' => 28,
                'telegram_url' => 'https://t.me/abebechkitchen',
            ],
            [
                'business_name' => 'Jimma Photography',
                'name' => 'Dawit Haile',
                'email' => 'photo@jimmavendors.com',
                'category' => 'Photography',
                'description' => 'Professional photography and videography services for weddings, events, and portraits.',
                'phone' => '+251944444444',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Kitfur',
                'rating' => 4.9,
                'total_reviews' => 67,
                'products_count' => 12,
                'instagram_url' => 'https://instagram.com/jimmaphotography',
            ],
            [
                'business_name' => 'HomeFix Jimma',
                'name' => 'Berhanu Tesfaye',
                'email' => 'homefix@jimmavendors.com',
                'category' => 'Home Services',
                'description' => 'Plumbing, electrical repairs, and home maintenance services.',
                'phone' => '+251955555555',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Bosa Addis Ketema',
                'rating' => 4.6,
                'total_reviews' => 43,
                'products_count' => 8,
            ],
            [
                'business_name' => 'Beauty by Sara',
                'name' => 'Sara Mohammed',
                'email' => 'beauty@jimmavendors.com',
                'category' => 'Health & Beauty',
                'description' => 'Salon, spa, and beauty treatments with traditional Ethiopian techniques.',
                'phone' => '+251966666666',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Mendera Kochi',
                'rating' => 4.8,
                'total_reviews' => 112,
                'products_count' => 24,
                'instagram_url' => 'https://instagram.com/beautybysara',
            ],
            [
                'business_name' => 'Tech Support Jimma',
                'name' => 'Yonas Ayele',
                'email' => 'tech@jimmavendors.com',
                'category' => 'Tech Support',
                'description' => 'Computer repair, phone fixing, and IT support services.',
                'phone' => '+251977777777',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Kitfur',
                'rating' => 4.5,
                'total_reviews' => 38,
                'products_count' => 6,
            ],
            [
                'business_name' => 'Event Masters',
                'name' => 'Solomon Desta',
                'email' => 'events@jimmavendors.com',
                'category' => 'Events & Party',
                'description' => 'Event planning, decorations, and party supplies for all occasions.',
                'phone' => '+251988888888',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Hermata',
                'rating' => 4.7,
                'total_reviews' => 84,
                'products_count' => 35,
                'instagram_url' => 'https://instagram.com/eventmasters',
            ],
            [
                'business_name' => 'AutoCare Jimma',
                'name' => 'Girma Bekele',
                'email' => 'auto@jimmavendors.com',
                'category' => 'Automotive',
                'description' => 'Car repair, maintenance, and detailing services.',
                'phone' => '+251999999999',
                'city' => 'Jimma',
                'state' => 'Oromia',
                'address_line1' => 'Bosa Addis Ketema',
                'rating' => 4.4,
                'total_reviews' => 52,
                'products_count' => 18,
            ],
        ];

        foreach ($vendors as $vendorData) {
            $location = $vendorData['city'] . ', ' . $vendorData['state'] . ', Ethiopia';
            
            $vendor = User::updateOrCreate(
                ['email' => $vendorData['email']],
                [
                    'name' => $vendorData['name'],
                    'business_name' => $vendorData['business_name'],
                    'password' => Hash::make('password'),
                    'role' => 'vendor',
                    'category' => $vendorData['category'],
                    'description' => $vendorData['description'],
                    'is_active' => true,
                    'email_verified_at' => now(),
                    'country' => 'Ethiopia',
                    'city' => $vendorData['city'],
                    'state' => $vendorData['state'],
                    'phone' => $vendorData['phone'],
                    'address_line1' => $vendorData['address_line1'],
                    'rating' => $vendorData['rating'],
                    'total_reviews' => $vendorData['total_reviews'],
                    'products_count' => $vendorData['products_count'],
                    'website' => $vendorData['website'] ?? null,
                    'facebook_url' => $vendorData['facebook_url'] ?? null,
                    'instagram_url' => $vendorData['instagram_url'] ?? null,
                    'telegram_url' => $vendorData['telegram_url'] ?? null,
                    'store_views' => rand(500, 5000),
                    'location' => $location,
                ]
            );
        }
        
        $this->command->info('✓ ' . count($vendors) . ' vendors created');
    }

    // /**
    //  * Create categories
    //  */
    // private function createCategories(): void
    // {
    //     $categories = [
    //         [
    //             'name' => 'Coffee & Tea',
    //             'slug' => Str::slug('Coffee & Tea'),
    //             'icon' => 'ri-cup-line',
    //             'description' => 'Fresh Ethiopian coffee and tea from local roasters',
    //             'short_description' => 'Fresh Ethiopian coffee and tea',
    //             'is_global' => true,
    //             'is_active' => true,
    //             'sort_order' => 1,
    //         ],
    //         [
    //             'name' => 'Traditional Handicrafts',
    //             'slug' => Str::slug('Traditional Handicrafts'),
    //             'icon' => 'ri-palette-line',
    //             'description' => 'Authentic Ethiopian crafts and artworks made by local artisans',
    //             'short_description' => 'Authentic Ethiopian crafts',
    //             'is_global' => true,
    //             'is_active' => true,
    //             'sort_order' => 2,
    //         ],
    //         [
    //             'name' => 'Ethiopian Food',
    //             'slug' => Str::slug('Ethiopian Food'),
    //             'icon' => 'ri-restaurant-line',
    //             'description' => 'Local restaurants and food vendors serving traditional cuisine',
    //             'short_description' => 'Local restaurants and food',
    //             'is_global' => true,
    //             'is_active' => true,
    //             'sort_order' => 3,
    //         ],
    //         [
    //             'name' => 'Home Services',
    //             'slug' => Str::slug('Home Services'),
    //             'icon' => 'ri-home-gear-line',
    //             'description' => 'Plumbers, electricians, and home maintenance professionals',
    //             'short_description' => 'Plumbers and electricians',
    //             'is_global' => true,
    //             'is_active' => true,
    //             'sort_order' => 4,
    //         ],
    //         [
    //             'name' => 'Photography',
    //             'slug' => Str::slug('Photography'),
    //             'icon' => 'ri-camera-lens-line',
    //             'description' => 'Professional photography and videography services',
    //             'short_description' => 'Professional photography',
    //             'is_global' => true,
    //             'is_active' => true,
    //             'sort_order' => 5,
    //         ],
    //         [
    //             'name' => 'Events & Party',
    //             'slug' => Str::slug('Events & Party'),
    //             'icon' => 'ri-cake-3-line',
    //             'description' => 'Event planning and party supplies for all occasions',
    //             'short_description' => 'Event planning',
    //             'is_global' => true,
    //             'is_active' => true,
    //             'sort_order' => 6,
    //         ],
    //         [
    //             'name' => 'Health & Beauty',
    //             'slug' => Str::slug('Health & Beauty'),
    //             'icon' => 'ri-heart-pulse-line',
    //             'description' => 'Salons, spas, and beauty treatments',
    //             'short_description' => 'Salons and spas',
    //             'is_global' => true,
    //             'is_active' => true,
    //             'sort_order' => 7,
    //         ],
    //         [
    //             'name' => 'Automotive',
    //             'slug' => Str::slug('Automotive'),
    //             'icon' => 'ri-car-washing-line',
    //             'description' => 'Car repair and maintenance services',
    //             'short_description' => 'Car repair',
    //             'is_global' => true,
    //             'is_active' => true,
    //             'sort_order' => 8,
    //         ],
    //         [
    //             'name' => 'Tech Support',
    //             'slug' => Str::slug('Tech Support'),
    //             'icon' => 'ri-computer-line',
    //             'description' => 'Computer repair, phone fixing, and IT support',
    //             'short_description' => 'Computer repair',
    //             'is_global' => true,
    //             'is_active' => true,
    //             'sort_order' => 9,
    //         ],
    //         [
    //             'name' => 'Textiles & Clothing',
    //             'slug' => Str::slug('Textiles & Clothing'),
    //             'icon' => 'ri-shirt-line',
    //             'description' => 'Traditional clothing, fabrics, and Habesha Kemis',
    //             'short_description' => 'Traditional clothing',
    //             'is_global' => true,
    //             'is_active' => true,
    //             'sort_order' => 10,
    //         ],
    //     ];

    //     foreach ($categories as $categoryData) {
    //         Category::updateOrCreate(
    //             ['slug' => $categoryData['slug']],
    //             $categoryData
    //         );
    //     }
        
    //     $this->command->info('✓ ' . count($categories) . ' categories created');
    // }




/**
 * Create categories
 */
private function createCategories(): void
{
    $categories = [
        [
            'name' => 'Coffee & Tea',
            'slug' => Str::slug('Coffee & Tea'),
            'icon' => 'ri-cup-line',
            'description' => 'Fresh Ethiopian coffee and tea from local roasters',
            'short_description' => 'Fresh Ethiopian coffee and tea',
            'is_global' => true,
            'is_active' => true,
            'sort_order' => 1,
        ],
        [
            'name' => 'Traditional Handicrafts',
            'slug' => Str::slug('Traditional Handicrafts'),
            'icon' => 'ri-palette-line',
            'description' => 'Authentic Ethiopian crafts and artworks made by local artisans',
            'short_description' => 'Authentic Ethiopian crafts',
            'is_global' => true,
            'is_active' => true,
            'sort_order' => 2,
        ],
        [
            'name' => 'Ethiopian Food',
            'slug' => Str::slug('Ethiopian Food'),
            'icon' => 'ri-restaurant-line',
            'description' => 'Local restaurants and food vendors serving traditional cuisine',
            'short_description' => 'Local restaurants and food',
            'is_global' => true,
            'is_active' => true,
            'sort_order' => 3,
        ],
        [
            'name' => 'Home Services',
            'slug' => Str::slug('Home Services'),
            'icon' => 'ri-home-gear-line',
            'description' => 'Plumbers, electricians, and home maintenance professionals',
            'short_description' => 'Plumbers and electricians',
            'is_global' => true,
            'is_active' => true,
            'sort_order' => 4,
        ],
        [
            'name' => 'Photography',
            'slug' => Str::slug('Photography'),
            'icon' => 'ri-camera-lens-line',
            'description' => 'Professional photography and videography services',
            'short_description' => 'Professional photography',
            'is_global' => true,
            'is_active' => true,
            'sort_order' => 5,
        ],
        [
            'name' => 'Events & Party',
            'slug' => Str::slug('Events & Party'),
            'icon' => 'ri-cake-3-line',
            'description' => 'Event planning and party supplies for all occasions',
            'short_description' => 'Event planning',
            'is_global' => true,
            'is_active' => true,
            'sort_order' => 6,
        ],
        [
            'name' => 'Health & Beauty',
            'slug' => Str::slug('Health & Beauty'),
            'icon' => 'ri-heart-pulse-line',
            'description' => 'Salons, spas, and beauty treatments',
            'short_description' => 'Salons and spas',
            'is_global' => true,
            'is_active' => true,
            'sort_order' => 7,
        ],
        [
            'name' => 'Automotive',
            'slug' => Str::slug('Automotive'),
            'icon' => 'ri-car-washing-line',
            'description' => 'Car repair and maintenance services',
            'short_description' => 'Car repair',
            'is_global' => true,
            'is_active' => true,
            'sort_order' => 8,
        ],
        [
            'name' => 'Tech Support',
            'slug' => Str::slug('Tech Support'),
            'icon' => 'ri-computer-line',
            'description' => 'Computer repair, phone fixing, and IT support',
            'short_description' => 'Computer repair',
            'is_global' => true,
            'is_active' => true,
            'sort_order' => 9,
        ],
        [
            'name' => 'Textiles & Clothing',
            'slug' => Str::slug('Textiles & Clothing'),
            'icon' => 'ri-shirt-line',
            'description' => 'Traditional clothing, fabrics, and Habesha Kemis',
            'short_description' => 'Traditional clothing',
            'is_global' => true,
            'is_active' => true,
            'sort_order' => 10,
        ],
    ];

    // Get the table columns to know what we can insert
    $columns = Schema::getColumnListing('categories');
    
    foreach ($categories as $categoryData) {
        // Filter data to only include columns that exist in the table
        $filteredData = array_intersect_key($categoryData, array_flip($columns));
        
        Category::updateOrCreate(
            ['slug' => $categoryData['slug']],
            $filteredData
        );
    }
    
    $this->command->info('✓ ' . count($categories) . ' categories created');
}





    /**
     * Populate the category_vendor pivot table
     */
    private function populateCategoryVendorPivot(): void
    {
        $vendors = User::where('role', 'vendor')->get();
        $categories = Category::all();
        
        if ($vendors->isEmpty() || $categories->isEmpty()) {
            $this->command->warn('⚠ No vendors or categories found to populate pivot table');
            return;
        }
        
        $relationshipsCreated = 0;
        
        foreach ($vendors as $vendor) {
            // Find the category that matches the vendor's category
            $matchingCategory = $categories->first(function($category) use ($vendor) {
                return str_contains(strtolower($category->name), strtolower($vendor->category)) ||
                       str_contains(strtolower($vendor->category), strtolower($category->name));
            });
            
            if ($matchingCategory) {
                // Attach the main category
                try {
                    DB::table('category_vendor')->updateOrInsert(
                        [
                            'category_id' => $matchingCategory->id,
                            'user_id' => $vendor->id,
                        ],
                        [
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                    $relationshipsCreated++;
                } catch (\Exception $e) {
                    // Skip if error
                }
            }
            
            // Attach 1-3 random additional categories
            $randomCount = min(rand(1, 3), $categories->count());
            $randomCategories = $categories->random($randomCount);
            
            foreach ($randomCategories as $category) {
                try {
                    DB::table('category_vendor')->updateOrInsert(
                        [
                            'category_id' => $category->id,
                            'user_id' => $vendor->id,
                        ],
                        [
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                    $relationshipsCreated++;
                } catch (\Exception $e) {
                    // Skip if duplicate or error
                }
            }
        }
        
        $this->command->info('✓ ' . $relationshipsCreated . ' category-vendor relationships created');
    }

    /**
     * Create sample products for vendors
     */
    private function createProducts(): void
    {
        $vendors = User::where('role', 'vendor')->get();
        
        if ($vendors->isEmpty()) {
            $this->command->warn('⚠ No vendors found to create products');
            return;
        }

        $categories = Category::all()->keyBy('name');
        $productsCreated = 0;

        foreach ($vendors as $vendor) {
            $categoryName = $vendor->category;
            
            // Find matching category
            $category = null;
            foreach ($categories as $cat) {
                if (str_contains(strtolower($cat->name), strtolower($categoryName)) || 
                    str_contains(strtolower($categoryName), strtolower($cat->name))) {
                    $category = $cat;
                    break;
                }
            }
            
            if (!$category) {
                $category = $categories->first(); // Default to first category
            }
            
            // Create 5-10 products per vendor
            $productCount = rand(5, 10);
            
            for ($i = 1; $i <= $productCount; $i++) {
                $productName = $this->generateProductName($vendor->business_name, $category->name, $i);
                
                // Generate a unique slug
                $baseSlug = Str::slug($productName);
                $slug = $baseSlug;
                $counter = 1;
                
                // Check if slug exists and make it unique
                while (Product::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter++;
                }
                
                $price = rand(50, 5000);
                $hasSale = rand(0, 1);
                $salePrice = $hasSale ? rand(30, $price - 10) : null;
                
                Product::updateOrCreate(
                    [
                        'vendor_id' => $vendor->id,
                        'name' => $productName,
                    ],
                    [
                        'slug' => $slug,
                        'category_id' => $category->id,
                        'category' => $category->name,
                        'description' => $this->generateProductDescription($vendor->business_name, $category->name),
                        'price' => $price,
                        'sale_price' => $salePrice,
                        'stock' => rand(5, 100),
                        'sold_count' => rand(0, 50),
                        'is_active' => true,
                        'status' => true,
                        'images' => json_encode([]),
                        'tags' => json_encode([$category->name, 'Ethiopian', 'Jimma']),
                        'views_count' => rand(10, 500),
                        'rating' => rand(35, 50) / 10, // 3.5 to 5.0
                        'created_at' => now()->subDays(rand(1, 60)),
                        'updated_at' => now(),
                    ]
                );
                
                $productsCreated++;
            }
        }
        
        $this->command->info('✓ ' . $productsCreated . ' products created');
    }

    /**
     * Generate product name
     */
    private function generateProductName(string $businessName, string $category, int $index): string
    {
        $coffeeNames = ['Ethiopian Yirgacheffe', 'Sidamo Roast', 'Jimma Special', 'Organic Blend', 'Espresso Roast', 'Coffee Beans 1kg'];
        $craftNames = ['Handwoven Basket', 'Traditional Cross', 'Ethiopian Scarf', 'Wooden Mask', 'Pottery Vase', 'Cultural Artifact'];
        $foodNames = ['Injera', 'Doro Wat', 'Kitfo', 'Shiro', 'Berbere Spice', 'Traditional Platter'];
        $serviceNames = ['Basic Service', 'Premium Package', 'Express Service', 'Deluxe Package', 'Standard Service', 'Professional Consultation'];
        $beautyNames = ['Haircut', 'Manicure', 'Facial Treatment', 'Massage', 'Traditional Hair Plaiting', 'Spa Package'];
        $techNames = ['Computer Repair', 'Phone Screen Fix', 'Virus Removal', 'Data Recovery', 'Network Setup', 'IT Consultation'];
        $eventNames = ['Wedding Package', 'Birthday Decoration', 'Event Planning', 'Catering Service', 'DJ Service', 'Photography Package'];
        
        if (str_contains(strtolower($category), 'coffee')) {
            return $coffeeNames[array_rand($coffeeNames)] . ' ' . $index;
        } elseif (str_contains(strtolower($category), 'handicraft')) {
            return $craftNames[array_rand($craftNames)] . ' ' . $index;
        } elseif (str_contains(strtolower($category), 'food')) {
            return $foodNames[array_rand($foodNames)] . ' ' . $index;
        } elseif (str_contains(strtolower($category), 'beauty') || str_contains(strtolower($category), 'health')) {
            return $beautyNames[array_rand($beautyNames)] . ' ' . $index;
        } elseif (str_contains(strtolower($category), 'tech')) {
            return $techNames[array_rand($techNames)] . ' ' . $index;
        } elseif (str_contains(strtolower($category), 'event')) {
            return $eventNames[array_rand($eventNames)] . ' ' . $index;
        } else {
            return $serviceNames[array_rand($serviceNames)] . ' ' . $index;
        }
    }

    /**
     * Generate product description
     */
    private function generateProductDescription(string $businessName, string $category): string
    {
        $descriptions = [
            "High-quality product from $businessName. Made with traditional Ethiopian techniques and care.",
            "Experience the best of $category with this premium offering from $businessName, a trusted Jimma vendor.",
            "Handcrafted with care by skilled artisans. Perfect for your needs and authentically Ethiopian.",
            "Authentic Ethiopian product that brings the taste and culture of Jimma to your home.",
            "Top-rated item from one of Jimma's most trusted vendors. Quality guaranteed.",
            "Sourced directly from local producers in Jimma. Fresh and authentic.",
            "Traditional Ethiopian craftsmanship at its finest. A must-have for enthusiasts.",
            "Premium quality product that showcases the best of Ethiopian culture and tradition.",
        ];
        
        return $descriptions[array_rand($descriptions)];
    }

    /**
     * Create testimonials
     */
    private function createTestimonials(): void
    {
        $testimonials = [
            [
                'author_name' => 'Abebe Kebede',
                'author_role' => 'Local Business Owner',
                'content' => 'Vendora helped me find the best coffee supplier in Jimma. The quality is amazing and delivery is always on time!',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'author_name' => 'Azeb Tadesse',
                'author_role' => 'Handicraft Artisan',
                'content' => 'As a vendor, Vendora has connected me with so many customers in Jimma. My handicraft business has grown tremendously!',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'author_name' => 'Tekle Berhan',
                'author_role' => 'Event Planner',
                'content' => 'I found an amazing photographer through Vendora for my wedding. The whole experience was seamless and professional.',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'author_name' => 'Hana Wondimu',
                'author_role' => 'Homeowner',
                'content' => 'The plumber I found on Vendora fixed my issue quickly and at a fair price. I highly recommend this platform!',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'author_name' => 'Mekdes Alemu',
                'author_role' => 'Restaurant Owner',
                'content' => 'Finding reliable food suppliers in Jimma has never been easier. Vendora connects us with the best local vendors.',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'author_name' => 'Dawit Mekonnen',
                'author_role' => 'Tourist',
                'content' => 'I discovered authentic Ethiopian crafts through Vendora. The quality exceeded my expectations and shipping was fast.',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'author_name' => 'Tigist Worku',
                'author_role' => 'Small Business Owner',
                'content' => 'Vendora has transformed how I find local services. Everything from catering to photography is just a click away.',
                'is_active' => true,
                'sort_order' => 7,
            ],
        ];

        foreach ($testimonials as $testimonialData) {
            Testimonial::updateOrCreate(
                [
                    'author_name' => $testimonialData['author_name'],
                    'content' => $testimonialData['content']
                ],
                $testimonialData
            );
        }
        
        $this->command->info('✓ ' . count($testimonials) . ' testimonials created');
    }

    /**
     * Create follower relationships
     */
    private function createFollowers(): void
    {
        $customers = User::where('role', 'customer')->get();
        $vendors = User::where('role', 'vendor')->get();
        
        if ($customers->isEmpty() || $vendors->isEmpty()) {
            $this->command->warn('⚠ No customers or vendors found to create followers');
            return;
        }
        
        $followersCreated = 0;
        
        foreach ($customers as $customer) {
            // Each customer follows 2-5 random vendors
            $followCount = rand(2, 5);
            $randomVendors = $vendors->random(min($followCount, $vendors->count()));
            
            foreach ($randomVendors as $vendor) {
                try {
                    // Check if already following
                    $exists = DB::table('followers')
                        ->where('follower_id', $customer->id)
                        ->where('vendor_id', $vendor->id)
                        ->exists();
                    
                    if (!$exists) {
                        DB::table('followers')->insert([
                            'follower_id' => $customer->id,
                            'vendor_id' => $vendor->id,
                            'created_at' => now()->subDays(rand(1, 30)),
                            'updated_at' => now(),
                        ]);
                        $followersCreated++;
                    }
                } catch (\Exception $e) {
                    // Skip if duplicate
                }
            }
        }
        
        $this->command->info('✓ ' . $followersCreated . ' follower relationships created');
    }

    /**
     * Update vendor stats based on actual data
     */
    private function updateVendorStats(): void
    {
        $vendors = User::where('role', 'vendor')->get();
        
        foreach ($vendors as $vendor) {
            // Count actual products
            $productCount = Product::where('vendor_id', $vendor->id)->count();
            
            // Count actual followers
            $followerCount = DB::table('followers')
                ->where('vendor_id', $vendor->id)
                ->count();
            
            // Update vendor record
            $vendor->products_count = $productCount;
            $vendor->save();
        }
        
        $this->command->info('✓ Vendor stats updated');
    }
}