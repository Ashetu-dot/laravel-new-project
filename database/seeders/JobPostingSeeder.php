<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobPosting;
use Carbon\Carbon;

class JobPostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing records to avoid duplicates
        JobPosting::truncate();

        $jobs = [
            [
                'title' => 'Senior Full Stack Developer',
                'type' => 'Full-time',
                'location' => 'Jimma / Remote',
                'description' => 'We\'re looking for an experienced Full Stack Developer to help build and scale our platform. You\'ll work on both frontend and backend, creating seamless experiences for vendors and customers.',
                'requirements' => [
                    '4+ years of experience with Laravel/PHP',
                    'Strong JavaScript/Vue.js skills',
                    'Experience with MySQL and database design',
                    'Familiarity with REST APIs and microservices',
                    'Understanding of Git and version control',
                    'Experience with cloud services (AWS, DigitalOcean)',
                ],
                'salary' => 'Competitive Salary',
                'is_active' => true,
                'sort_order' => 1,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Community Manager',
                'type' => 'Full-time',
                'location' => 'Jimma (On-site)',
                'description' => 'Join our team to build and nurture relationships with vendors and customers in Jimma and beyond. You\'ll be the face of Vendora in the community.',
                'requirements' => [
                    '2+ years in community management or similar',
                    'Excellent communication in Amharic and English',
                    'Experience with social media management',
                    'Passion for local business development',
                    'Strong organizational and event planning skills',
                    'Ability to work flexible hours',
                ],
                'salary' => 'Competitive Salary',
                'is_active' => true,
                'sort_order' => 2,
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'UI/UX Designer',
                'type' => 'Full-time',
                'location' => 'Jimma / Remote',
                'description' => 'Design beautiful, intuitive experiences for our users. You\'ll work on both vendor and customer interfaces, making our platform easy and enjoyable to use.',
                'requirements' => [
                    '3+ years of UI/UX design experience',
                    'Proficiency in Figma, Adobe XD',
                    'Portfolio demonstrating user-centered design',
                    'Experience with mobile-first design',
                    'Understanding of HTML/CSS and frontend principles',
                    'Ability to conduct user research and testing',
                ],
                'salary' => 'Competitive Salary',
                'is_active' => true,
                'sort_order' => 3,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Sales & Partnerships Lead',
                'type' => 'Full-time',
                'location' => 'Jimma (On-site)',
                'description' => 'Drive our growth by building relationships with vendors and strategic partners across Ethiopia. You\'ll be key to expanding our vendor network.',
                'requirements' => [
                    '3+ years in sales or business development',
                    'Strong network in Ethiopian business community',
                    'Excellent negotiation and communication skills',
                    'Fluent in Amharic and English',
                    'Experience with CRM software',
                    'Proven track record of meeting targets',
                ],
                'salary' => 'Competitive + Commission',
                'is_active' => true,
                'sort_order' => 4,
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Marketing Specialist',
                'type' => 'Full-time',
                'location' => 'Jimma / Remote',
                'description' => 'We\'re seeking a creative Marketing Specialist to help grow our brand awareness and drive customer acquisition through digital marketing channels.',
                'requirements' => [
                    '2+ years of digital marketing experience',
                    'Experience with social media advertising',
                    'Knowledge of SEO/SEM best practices',
                    'Content creation skills',
                    'Analytics and reporting abilities',
                    'Experience with email marketing platforms',
                ],
                'salary' => 'Competitive Salary',
                'is_active' => true,
                'sort_order' => 5,
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Customer Support Representative',
                'type' => 'Full-time',
                'location' => 'Jimma (On-site)',
                'description' => 'Join our support team to help vendors and customers with their questions and issues. You\'ll be the first point of contact for users needing assistance.',
                'requirements' => [
                    '1+ year of customer service experience',
                    'Excellent communication in Amharic and English',
                    'Problem-solving skills',
                    'Patience and empathy',
                    'Basic computer skills',
                    'Ability to work in shifts',
                ],
                'salary' => 'Competitive Salary',
                'is_active' => true,
                'sort_order' => 6,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        $count = 0;
        foreach ($jobs as $jobData) {
            // Ensure requirements are properly encoded as JSON
            if (is_array($jobData['requirements'])) {
                $jobData['requirements'] = json_encode($jobData['requirements']);
            }
            
            JobPosting::create($jobData);
            $count++;
        }
        
        $this->command->info("✓ {$count} job postings seeded successfully!");
        
        // Display summary table
        $this->command->table(
            ['ID', 'Title', 'Type', 'Location', 'Status'],
            JobPosting::all(['id', 'title', 'type', 'location', 'is_active'])->map(function($job) {
                return [
                    $job->id,
                    $job->title,
                    $job->type,
                    $job->location,
                    $job->is_active ? 'Active' : 'Inactive',
                ];
            })->toArray()
        );
    }
}
