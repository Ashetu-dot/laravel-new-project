<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Food & Beverage Categories
            [
                'name' => 'Coffee & Tea',
                'slug' => Str::slug('Coffee & Tea'),
                'icon' => 'ri-cup-line',
                'description' => 'Traditional Ethiopian coffee and tea products from local roasters and growers.',
                'short_description' => 'Fresh Ethiopian coffee and tea',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ethiopian Food & Spices',
                'slug' => Str::slug('Ethiopian Food & Spices'),
                'icon' => 'ri-restaurant-line',
                'description' => 'Traditional food products, spices, and ingredients for authentic Ethiopian cuisine.',
                'short_description' => 'Traditional food and spices',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Handicrafts & Art Categories
            [
                'name' => 'Traditional Handicrafts',
                'slug' => Str::slug('Traditional Handicrafts'),
                'icon' => 'ri-palette-line',
                'description' => 'Handmade crafts, baskets, and traditional items made by local artisans.',
                'short_description' => 'Handmade crafts and traditional items',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Art & Paintings',
                'slug' => Str::slug('Art & Paintings'),
                'icon' => 'ri-paint-brush-line',
                'description' => 'Ethiopian art, paintings, and cultural artwork from local artists.',
                'short_description' => 'Ethiopian art and paintings',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Fashion & Jewelry Categories
            [
                'name' => 'Textiles & Habesha Kemis',
                'slug' => Str::slug('Textiles & Habesha Kemis'),
                'icon' => 'ri-shirt-line',
                'description' => 'Traditional Ethiopian clothing, fabrics, and modern Habesha fashion.',
                'short_description' => 'Traditional clothing and fabrics',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Traditional Jewelry',
                'slug' => Str::slug('Traditional Jewelry'),
                'icon' => 'ri-star-line',
                'description' => 'Handmade traditional jewelry, crosses, and accessories.',
                'short_description' => 'Handmade traditional jewelry',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Services Categories
            [
                'name' => 'Photography',
                'slug' => Str::slug('Photography'),
                'icon' => 'ri-camera-lens-line',
                'description' => 'Professional photography and videography services for events and portraits.',
                'short_description' => 'Professional photography services',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Events & Party',
                'slug' => Str::slug('Events & Party'),
                'icon' => 'ri-cake-3-line',
                'description' => 'Event planning, decorations, and party supplies for all occasions.',
                'short_description' => 'Event planning and party supplies',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Home Services',
                'slug' => Str::slug('Home Services'),
                'icon' => 'ri-home-gear-line',
                'description' => 'Plumbing, electrical repairs, and home maintenance services.',
                'short_description' => 'Plumbing, electrical, and repairs',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Automotive',
                'slug' => Str::slug('Automotive'),
                'icon' => 'ri-car-washing-line',
                'description' => 'Car repair, maintenance, and detailing services.',
                'short_description' => 'Car repair and maintenance',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health & Beauty',
                'slug' => Str::slug('Health & Beauty'),
                'icon' => 'ri-heart-pulse-line',
                'description' => 'Salons, spas, and beauty treatments with traditional techniques.',
                'short_description' => 'Salons, spas, and beauty',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tech Support',
                'slug' => Str::slug('Tech Support'),
                'icon' => 'ri-computer-line',
                'description' => 'Computer repair, phone fixing, and IT support services.',
                'short_description' => 'Computer and phone repair',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Services',
                'slug' => Str::slug('Services'),
                'icon' => 'ri-customer-service-2-line',
                'description' => 'Various professional services offered by local vendors.',
                'short_description' => 'Professional services',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Electronics Category
            [
                'name' => 'Electronics',
                'slug' => Str::slug('Electronics'),
                'icon' => 'ri-device-line',
                'description' => 'Electronic devices, accessories, and gadgets.',
                'short_description' => 'Electronics and accessories',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Sub-categories for Services (optional)
            [
                'name' => 'Plumbing',
                'slug' => Str::slug('Plumbing'),
                'icon' => 'ri-tools-line',
                'description' => 'Professional plumbing services for homes and businesses.',
                'short_description' => 'Plumbing services',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null, // You would set this to the ID of 'Home Services' after creation
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electrical',
                'slug' => Str::slug('Electrical'),
                'icon' => 'ri-flashlight-line',
                'description' => 'Electrical repairs and installations by certified electricians.',
                'short_description' => 'Electrical services',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null, // You would set this to the ID of 'Home Services' after creation
                'image' => null,
                'vendor_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // First, create all parent categories
        $parentCategories = array_filter($categories, function($cat) {
            return !in_array($cat['name'], ['Plumbing', 'Electrical']); // Filter out sub-categories
        });

        foreach ($parentCategories as $categoryData) {
            Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }

        // Now get the ID of Home Services for sub-categories
        $homeServices = Category::where('slug', Str::slug('Home Services'))->first();
        
        if ($homeServices) {
            // Update sub-categories with parent_id
            Category::updateOrCreate(
                ['slug' => Str::slug('Plumbing')],
                [
                    'name' => 'Plumbing',
                    'slug' => Str::slug('Plumbing'),
                    'icon' => 'ri-tools-line',
                    'description' => 'Professional plumbing services for homes and businesses.',
                    'short_description' => 'Plumbing services',
                    'is_global' => true,
                    'is_active' => true,
                    'parent_id' => $homeServices->id,
                    'image' => null,
                    'vendor_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );

            Category::updateOrCreate(
                ['slug' => Str::slug('Electrical')],
                [
                    'name' => 'Electrical',
                    'slug' => Str::slug('Electrical'),
                    'icon' => 'ri-flashlight-line',
                    'description' => 'Electrical repairs and installations by certified electricians.',
                    'short_description' => 'Electrical services',
                    'is_global' => true,
                    'is_active' => true,
                    'parent_id' => $homeServices->id,
                    'image' => null,
                    'vendor_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // Count categories created
        $count = Category::count();
        $this->command->info("{$count} categories seeded successfully!");
        
        // Show summary
        $this->command->table(
            ['ID', 'Name', 'Slug', 'Icon', 'Parent'],
            Category::all()->map(function($cat) {
                return [
                    $cat->id,
                    $cat->name,
                    $cat->slug,
                    $cat->icon,
                    $cat->parent ? $cat->parent->name : 'None',
                ];
            })->toArray()
        );
    }
}