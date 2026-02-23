<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Models\User;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // Create categories
        $categories = [
            ['name' => 'Community Spotlight', 'slug' => 'community-spotlight', 'icon' => 'heart-line'],
            ['name' => 'Vendor Success', 'slug' => 'vendor-success', 'icon' => 'handbag-line'],
            ['name' => 'Tips & Tricks', 'slug' => 'tips-tricks', 'icon' => 'lightbulb-line'],
            ['name' => 'Photography', 'slug' => 'photography', 'icon' => 'camera-line'],
            ['name' => 'Food & Drink', 'slug' => 'food-drink', 'icon' => 'restaurant-line'],
            ['name' => 'Home Services', 'slug' => 'home-services', 'icon' => 'home-gear-line'],
            ['name' => 'Health & Beauty', 'slug' => 'health-beauty', 'icon' => 'heart-pulse-line'],
        ];

        foreach ($categories as $cat) {
            BlogCategory::create($cat);
        }

        // Create tags
        $tags = ['Jimma', 'Ethiopia', 'Coffee', 'Handicrafts', 'Wedding', 'Photography', 'Food', 'Beauty', 'HomeServices', 'Vendors', 'SuccessStory', 'Tips'];
        foreach ($tags as $tagName) {
            BlogTag::create([
                'name' => $tagName,
                'slug' => strtolower($tagName)
            ]);
        }

        // Get admin user or create one
        $author = User::where('role', 'admin')->first();
        if (!$author) {
            $author = User::create([
                'name' => 'Admin User',
                'email' => 'admin@vendora.com',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ]);
        }

        // Create sample posts
        $samplePosts = [
            [
                'title' => 'How Jimma\'s Coffee Vendors Are Going Digital',
                'slug' => 'jimma-coffee-vendors-digital',
                'excerpt' => 'Discover how local coffee roasters in Jimma are using Vendora to reach new customers and preserve traditional Ethiopian coffee culture in the digital age.',
                'content' => 'Full content here...',
                'category_id' => 1,
                'author_id' => $author->id,
                'author_name' => $author->name,
                'author_title' => 'Community Manager',
                'icon' => 'store-3-line',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now(),
                'read_time' => 5,
            ],
            [
                'title' => 'From Local Shop to Online Success: A Vendora Story',
                'slug' => 'local-shop-online-success',
                'excerpt' => 'How a traditional handicraft shop in Jimma grew their business 300% in just 6 months using Vendora\'s platform.',
                'content' => 'Full content here...',
                'category_id' => 2,
                'author_id' => $author->id,
                'author_name' => $author->name,
                'author_title' => 'Content Writer',
                'icon' => 'handbag-line',
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'read_time' => 4,
            ],
            // Add more posts as needed
        ];

        foreach ($samplePosts as $post) {
            BlogPost::create($post);
        }
    }
}