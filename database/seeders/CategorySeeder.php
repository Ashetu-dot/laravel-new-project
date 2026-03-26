<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure storage directory exists
        $this->ensureStorageDirectory();

        $categories = [
            // Food & Beverage Categories
            [
                'name' => 'Coffee & Tea',
                'slug' => Str::slug('Coffee & Tea'),
                'description' => 'Traditional Ethiopian coffee and tea products from local roasters and growers.',
                'short_description' => 'Fresh Ethiopian coffee and tea',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#6F4E37', // Coffee brown
                'image_url' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?w=800&h=600&fit=crop', // Coffee beans
                'placeholder_image' => 'categories/coffee-tea-placeholder.jpg',
            ],
            [
                'name' => 'Ethiopian Food & Spices',
                'slug' => Str::slug('Ethiopian Food & Spices'),
                'description' => 'Traditional food products, spices, and ingredients for authentic Ethiopian cuisine.',
                'short_description' => 'Traditional food and spices',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#D2691E', // Spice orange
                'image_url' => 'https://images.unsplash.com/photo-1532336414038-cf19250c5757?w=800&h=600&fit=crop', // Spices
                'placeholder_image' => 'categories/ethiopian-food-spices-placeholder.jpg',
            ],

            // Handicrafts & Art Categories
            [
                'name' => 'Traditional Handicrafts',
                'slug' => Str::slug('Traditional Handicrafts'),
                'description' => 'Handmade crafts, baskets, and traditional items made by local artisans.',
                'short_description' => 'Handmade crafts and traditional items',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#8B4513', // Saddle brown
                'image_url' => 'https://images.unsplash.com/photo-1562322140-8baeececf3df?w=800&h=600&fit=crop', // Handicrafts
                'placeholder_image' => 'categories/handicrafts-placeholder.jpg',
            ],
            [
                'name' => 'Art & Paintings',
                'slug' => Str::slug('Art & Paintings'),
                'description' => 'Ethiopian art, paintings, and cultural artwork from local artists.',
                'short_description' => 'Ethiopian art and paintings',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#C41E3A', // Cardinal red
                'image_url' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?w=800&h=600&fit=crop', // Art
                'placeholder_image' => 'categories/art-paintings-placeholder.jpg',
            ],

            // Fashion & Jewelry Categories
            [
                'name' => 'Textiles & Habesha Kemis',
                'slug' => Str::slug('Textiles & Habesha Kemis'),
                'description' => 'Traditional Ethiopian clothing, fabrics, and modern Habesha fashion.',
                'short_description' => 'Traditional clothing and fabrics',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#9B2E46', // Ethiopian traditional color
                'image_url' => 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?w=800&h=600&fit=crop', // Textiles
                'placeholder_image' => 'categories/textiles-placeholder.jpg',
            ],
            [
                'name' => 'Traditional Jewelry',
                'slug' => Str::slug('Traditional Jewelry'),
                'description' => 'Handmade traditional jewelry, crosses, and accessories.',
                'short_description' => 'Handmade traditional jewelry',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#D4AF37', // Gold
                'image_url' => 'https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?w=800&h=600&fit=crop', // Jewelry
                'placeholder_image' => 'categories/jewelry-placeholder.jpg',
            ],

            // Services Categories
            [
                'name' => 'Photography',
                'slug' => Str::slug('Photography'),
                'description' => 'Professional photography and videography services for events and portraits.',
                'short_description' => 'Professional photography services',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#2C3E50', // Dark blue-gray
                'image_url' => 'https://images.unsplash.com/photo-1554048612-b6a482bc67e5?w=800&h=600&fit=crop', // Photography
                'placeholder_image' => 'categories/photography-placeholder.jpg',
            ],
            [
                'name' => 'Events & Party',
                'slug' => Str::slug('Events & Party'),
                'description' => 'Event planning, decorations, and party supplies for all occasions.',
                'short_description' => 'Event planning and party supplies',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#FF69B4', // Hot pink
                'image_url' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?w=800&h=600&fit=crop', // Events
                'placeholder_image' => 'categories/events-party-placeholder.jpg',
            ],
            [
                'name' => 'Home Services',
                'slug' => Str::slug('Home Services'),
                'description' => 'Plumbing, electrical repairs, and home maintenance services.',
                'short_description' => 'Plumbing, electrical, and repairs',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#20B2AA', // Light sea green
                'image_url' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=800&h=600&fit=crop', // Home services
                'placeholder_image' => 'categories/home-services-placeholder.jpg',
            ],
            [
                'name' => 'Automotive',
                'slug' => Str::slug('Automotive'),
                'description' => 'Car repair, maintenance, and detailing services.',
                'short_description' => 'Car repair and maintenance',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#4169E1', // Royal blue
                'image_url' => 'https://images.unsplash.com/photo-1486006920555-c77dcf18193c?w=800&h=600&fit=crop', // Automotive
                'placeholder_image' => 'categories/automotive-placeholder.jpg',
            ],
            [
                'name' => 'Health & Beauty',
                'slug' => Str::slug('Health & Beauty'),
                'description' => 'Salons, spas, and beauty treatments with traditional techniques.',
                'short_description' => 'Salons, spas, and beauty',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#FF6B6B', // Coral
                'image_url' => 'https://images.unsplash.com/photo-1522337660859-02fbefca4702?w=800&h=600&fit=crop', // Beauty
                'placeholder_image' => 'categories/health-beauty-placeholder.jpg',
            ],
            [
                'name' => 'Tech Support',
                'slug' => Str::slug('Tech Support'),
                'description' => 'Computer repair, phone fixing, and IT support services.',
                'short_description' => 'Computer and phone repair',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#3498DB', // Bright blue
                'image_url' => 'https://images.unsplash.com/photo-1517433456452-f9633a875f6f?w=800&h=600&fit=crop', // Tech
                'placeholder_image' => 'categories/tech-support-placeholder.jpg',
            ],
            [
                'name' => 'Services',
                'slug' => Str::slug('Services'),
                'description' => 'Various professional services offered by local vendors.',
                'short_description' => 'Professional services',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#95A5A6', // Gray
                'image_url' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&h=600&fit=crop', // Services
                'placeholder_image' => 'categories/services-placeholder.jpg',
            ],

            // Electronics Category
            [
                'name' => 'Electronics',
                'slug' => Str::slug('Electronics'),
                'description' => 'Electronic devices, accessories, and gadgets.',
                'short_description' => 'Electronics and accessories',
                'is_global' => true,
                'is_active' => true,
                'parent_id' => null,
                'vendor_id' => null,
                'image_color' => '#2ECC71', // Emerald
                'image_url' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=800&h=600&fit=crop', // Electronics
                'placeholder_image' => 'categories/electronics-placeholder.jpg',
            ],
        ];

        // First, create all parent categories
        $parentCategories = array_filter($categories, function($cat) {
            return !in_array($cat['name'], ['Plumbing', 'Electrical']); // Filter out sub-categories
        });

        foreach ($parentCategories as $categoryData) {
            // Download and store image
            $imagePath = $this->downloadAndStoreImage($categoryData['image_url'], $categoryData['placeholder_image']);

            // Remove temporary fields and add image path
            unset($categoryData['image_url']);
            unset($categoryData['placeholder_image']);
            $categoryData['image'] = $imagePath;

            Category::updateOrCreate(
                ['slug' => $categoryData['slug']],
                $categoryData
            );
        }

        // Now get the ID of Home Services for sub-categories
        $homeServices = Category::where('slug', Str::slug('Home Services'))->first();

        if ($homeServices) {
            // Sub-categories with images
            $subCategories = [
                [
                    'name' => 'Plumbing',
                    'slug' => Str::slug('Plumbing'),
                    'description' => 'Professional plumbing services for homes and businesses.',
                    'short_description' => 'Plumbing services',
                    'is_global' => true,
                    'is_active' => true,
                    'parent_id' => $homeServices->id,
                    'vendor_id' => null,
                    'image_color' => '#00CED1', // Dark turquoise
                    'image_url' => 'https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?w=800&h=600&fit=crop', // Plumbing
                    'placeholder_image' => 'categories/plumbing-placeholder.jpg',
                ],
                [
                    'name' => 'Electrical',
                    'slug' => Str::slug('Electrical'),
                    'description' => 'Electrical repairs and installations by certified electricians.',
                    'short_description' => 'Electrical services',
                    'is_global' => true,
                    'is_active' => true,
                    'parent_id' => $homeServices->id,
                    'vendor_id' => null,
                    'image_color' => '#FFA500', // Orange
                    'image_url' => 'https://images.unsplash.com/photo-1621905251189-08b45d6a269e?w=800&h=600&fit=crop', // Electrical
                    'placeholder_image' => 'categories/electrical-placeholder.jpg',
                ],
            ];

            foreach ($subCategories as $subCategoryData) {
                // Download and store image
                $imagePath = $this->downloadAndStoreImage($subCategoryData['image_url'], $subCategoryData['placeholder_image']);

                // Remove temporary fields and add image path
                unset($subCategoryData['image_url']);
                unset($subCategoryData['placeholder_image']);
                $subCategoryData['image'] = $imagePath;

                Category::updateOrCreate(
                    ['slug' => $subCategoryData['slug']],
                    $subCategoryData
                );
            }
        }

        // Count categories created
        $count = Category::count();
        $this->command->info("{$count} categories seeded successfully!");

        // Show summary
        $this->command->table(
            ['ID', 'Name', 'Slug', 'Image', 'Parent', 'Color'],
            Category::all()->map(function($cat) {
                return [
                    $cat->id,
                    $cat->name,
                    $cat->slug,
                    $cat->image ? '✓' : '✗',
                    $cat->parent ? $cat->parent->name : 'None',
                    $cat->image_color ?? 'N/A',
                ];
            })->toArray()
        );
    }

    /**
     * Ensure storage directory exists
     */
    private function ensureStorageDirectory(): void
    {
        $directories = [
            storage_path('app/public/categories'),
            storage_path('app/public/categories/thumbnails'),
        ];

        foreach ($directories as $directory) {
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
        }

        // Link storage if not already linked
        if (!file_exists(public_path('storage'))) {
            $this->command->call('storage:link');
        }
    }

    /**
     * Download and store image from URL
     */
    private function downloadAndStoreImage(string $url, string $placeholderName): string
    {
        try {
            // Generate unique filename
            $filename = pathinfo($placeholderName, PATHINFO_FILENAME) . '_' . time() . '.jpg';
            $path = 'categories/' . $filename;

            // Download image content
            $imageContent = file_get_contents($url);

            if ($imageContent !== false) {
                // Store image
                Storage::disk('public')->put($path, $imageContent);

                // Create thumbnail (optional - you can implement this with Intervention Image if needed)
                $this->createThumbnail($path);

                return $path;
            }
        } catch (\Exception $e) {
            $this->command->warn("Could not download image from {$url}: " . $e->getMessage());
        }

        // Return a placeholder if download fails
        return $this->createPlaceholderImage($placeholderName);
    }

    /**
     * Create a placeholder image with category name and color
     */
    private function createPlaceholderImage(string $placeholderName): string
    {
        $filename = pathinfo($placeholderName, PATHINFO_FILENAME) . '_placeholder.png';
        $path = 'categories/' . $filename;

        // You can implement GD or Imagick to create placeholder images
        // For now, return a default placeholder
        return 'categories/default-placeholder.jpg';
    }

    /**
     * Create thumbnail for category image
     */
    private function createThumbnail(string $imagePath): void
    {
        // Implementation with Intervention Image if needed
        // This is optional and can be implemented later
    }
}