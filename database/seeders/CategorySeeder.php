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
            [
                'name' => 'Coffee & Tea',
                'slug' => Str::slug('Coffee & Tea'),
                'description' => 'Traditional Ethiopian coffee and tea products',
                'is_global' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Traditional Handicrafts',
                'slug' => Str::slug('Traditional Handicrafts'),
                'description' => 'Handmade crafts and traditional items',
                'is_global' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Textiles & Habesha Kemis',
                'slug' => Str::slug('Textiles & Habesha Kemis'),
                'description' => 'Traditional Ethiopian clothing and fabrics',
                'is_global' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ethiopian Food & Spices',
                'slug' => Str::slug('Ethiopian Food & Spices'),
                'description' => 'Traditional food products and spices',
                'is_global' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Traditional Jewelry',
                'slug' => Str::slug('Traditional Jewelry'),
                'description' => 'Handmade traditional jewelry',
                'is_global' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Art & Paintings',
                'slug' => Str::slug('Art & Paintings'),
                'description' => 'Ethiopian art and paintings',
                'is_global' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Electronics',
                'slug' => Str::slug('Electronics'),
                'description' => 'Electronic devices and accessories',
                'is_global' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Services',
                'slug' => Str::slug('Services'),
                'description' => 'Various services offered',
                'is_global' => true,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
        
        $this->command->info('Categories seeded successfully!');
    }
}