<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VideoTutorial;
use Illuminate\Support\Str;

class VideoTutorialSeeder extends Seeder
{
    public function run(): void
    {
        $videos = [
            [
                'title' => 'Getting Started with Vendora Admin Dashboard',
                'description' => 'Learn the basics of navigating the Vendora admin dashboard. This tutorial covers the main sections, navigation, and essential features to help you get started quickly.',
                'youtube_id' => 'dQw4w9WgXcQ', // Replace with actual YouTube IDs
                'category' => 'Getting Started',
                'tags' => ['basics', 'navigation', 'dashboard'],
                'duration' => 480, // 8 minutes
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Managing Orders: Complete Guide',
                'description' => 'A comprehensive guide to managing orders in Vendora. Learn how to process orders, update statuses, handle refunds, and manage customer communications.',
                'youtube_id' => 'dQw4w9WgXcQ',
                'category' => 'Orders',
                'tags' => ['orders', 'processing', 'refunds'],
                'duration' => 720, // 12 minutes
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Vendor Management Best Practices',
                'description' => 'Learn how to effectively manage vendors, approve applications, monitor performance, and handle vendor communications.',
                'youtube_id' => 'dQw4w9WgXcQ',
                'category' => 'Vendors',
                'tags' => ['vendors', 'approvals', 'management'],
                'duration' => 540, // 9 minutes
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Creating and Managing Promotions',
                'description' => 'Step-by-step guide to creating effective promotions, discount codes, and marketing campaigns in Vendora.',
                'youtube_id' => 'dQw4w9WgXcQ',
                'category' => 'Marketing',
                'tags' => ['promotions', 'discounts', 'marketing'],
                'duration' => 600, // 10 minutes
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Inventory Management Tips',
                'description' => 'Master inventory management with these pro tips. Learn about stock tracking, low stock alerts, and bulk updates.',
                'youtube_id' => 'dQw4w9WgXcQ',
                'category' => 'Inventory',
                'tags' => ['inventory', 'stock', 'products'],
                'duration' => 420, // 7 minutes
                'is_featured' => false,
            ],
            [
                'title' => 'Customer Support Best Practices',
                'description' => 'Learn how to provide excellent customer support using the Vendora messaging and ticket systems.',
                'youtube_id' => 'dQw4w9WgXcQ',
                'category' => 'Support',
                'tags' => ['support', 'messages', 'tickets'],
                'duration' => 540, // 9 minutes
                'is_featured' => false,
            ],
            [
                'title' => 'Analytics and Reporting Guide',
                'description' => 'Understand your business better with Vendora analytics. Learn to read reports and make data-driven decisions.',
                'youtube_id' => 'dQw4w9WgXcQ',
                'category' => 'Analytics',
                'tags' => ['analytics', 'reports', 'data'],
                'duration' => 660, // 11 minutes
                'is_featured' => true,
            ],
            [
                'title' => 'Setting Up Your Store Settings',
                'description' => 'Configure your store settings properly with this comprehensive guide covering taxes, shipping, and payment methods.',
                'youtube_id' => 'dQw4w9WgXcQ',
                'category' => 'Settings',
                'tags' => ['settings', 'configuration', 'setup'],
                'duration' => 480, // 8 minutes
                'is_featured' => false,
            ],
        ];

        foreach ($videos as $video) {
            VideoTutorial::create([
                'title' => $video['title'],
                'slug' => Str::slug($video['title']),
                'description' => $video['description'],
                'youtube_id' => $video['youtube_id'],
                'category' => $video['category'],
                'tags' => json_encode($video['tags']),
                'duration' => $video['duration'],
                'is_featured' => $video['is_featured'],
                'sort_order' => $video['sort_order'] ?? 0,
                'is_published' => true,
                'views_count' => rand(100, 5000),
                'thumbnail' => null, // You can add thumbnail URLs here
            ]);
        }
    }
}