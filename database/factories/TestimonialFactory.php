<?php

namespace Database\Factories;

use App\Models\Testimonial;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Support\Str;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $names = [
            'Abebe Kebede', 'Azeb Tadesse', 'Tekle Berhan',
            'Hana Wondimu', 'Mekdes Alemu', 'Dawit Haile',
            'Sara Mohammed', 'Yonas Ayele', 'Girma Bekele',
            'Meron Assefa', 'Henok Tesfaye', 'Tigist Worku',
            'Biruk Alemayehu', 'Eden Girmay', 'Nahom Tekle'
        ];

        $roles = [
            'Local Business Owner', 'Customer', 'Event Planner',
            'Homeowner', 'Restaurant Owner', 'Teacher',
            'Hotel Manager', 'Tourist', 'Shop Owner',
            'Coffee Shop Owner', 'Artisan', 'Freelancer',
            'Small Business Owner', 'Interior Designer', 'Chef'
        ];

        $detailedTestimonials = [
            [
                'content' => 'Vendora helped me find the best coffee supplier in Jimma. The quality is amazing! I have been using their services for over a year now and my customers love the coffee. Highly recommended for anyone looking for authentic Ethiopian coffee.',
                'rating' => 5
            ],
            [
                'content' => 'As a vendor, Vendora has connected me with so many customers. My business has grown tremendously! The platform is intuitive and the support team is always there to help.',
                'rating' => 5
            ],
            [
                'content' => 'I found an amazing photographer through Vendora. The whole experience was seamless from booking to delivery. The photos turned out beautiful and the price was reasonable.',
                'rating' => 4.5
            ],
            [
                'content' => 'The plumber I found on Vendora fixed my issue quickly at a fair price. He was professional, arrived on time, and did excellent work. I will definitely use this platform again.',
                'rating' => 5
            ],
            [
                'content' => 'Finding reliable food suppliers in Jimma has never been easier. Vendora connects you with trusted vendors who deliver quality products consistently.',
                'rating' => 4.5
            ],
            [
                'content' => 'Great platform for connecting with local professionals. I use it for all my service needs - from home repairs to event planning. The vendor ratings and reviews are very helpful.',
                'rating' => 5
            ],
            [
                'content' => 'The customer support team is very helpful. They resolved my issue within hours and followed up to ensure everything was working properly. Excellent service!',
                'rating' => 5
            ],
            [
                'content' => 'I love supporting local businesses through Vendora. It makes finding services so easy and I feel good knowing I\'m contributing to the local economy.',
                'rating' => 4.5
            ],
            [
                'content' => 'Excellent selection of vendors. I found exactly what I was looking for - traditional Ethiopian textiles and Habesha Kemis. The quality exceeded my expectations.',
                'rating' => 5
            ],
            [
                'content' => 'The traditional jewelry I purchased through Vendora is stunning. The craftsmanship is exceptional and the vendor was very communicative throughout the process.',
                'rating' => 5
            ],
            [
                'content' => 'Vendora has transformed how I source ingredients for my restaurant. The quality of spices and traditional ingredients is exceptional. My customers keep coming back!',
                'rating' => 5
            ],
            [
                'content' => 'I was visiting Ethiopia and needed to find authentic souvenirs. Vendora connected me with local artisans who make beautiful handmade crafts. Amazing experience!',
                'rating' => 4.5
            ],
            [
                'content' => 'The tech support I found through Vendora fixed my computer issues quickly. The technician was knowledgeable and professional. Will definitely use again.',
                'rating' => 5
            ],
            [
                'content' => 'Great platform for finding reliable home services. The electrician I hired was professional and did quality work at a fair price.',
                'rating' => 4.5
            ],
            [
                'content' => 'Vendora has been instrumental in helping us find reliable suppliers for our hotel. From coffee to textiles, we have found excellent vendors.',
                'rating' => 5
            ],
        ];

        $testimonialData = $this->faker->randomElement($detailedTestimonials);

        // Determine if testimonial should have a response (30% chance)
        $hasResponse = $this->faker->boolean(30);
        $responseDate = $hasResponse ? $this->faker->dateTimeBetween('-30 days', 'now') : null;

        return [
            'author_name' => $this->faker->randomElement($names),
            'author_role' => $this->faker->randomElement($roles),
            'author_image' => $this->generateAuthorImage(),
            'content' => $testimonialData['content'],
            'rating' => $testimonialData['rating'],
            'is_active' => $this->faker->boolean(90), // 90% active
            'verified' => $this->faker->boolean(70), // 70% verified
            'featured' => $this->faker->boolean(15), // 15% featured
            'sort_order' => $this->faker->numberBetween(1, 100),
            'vendor_id' => $this->getRandomVendorId(),
            'product_id' => null, // Will be set conditionally
            'user_id' => $this->getRandomUserId(),
            'response' => $hasResponse ? $this->generateResponse() : null,
            'response_date' => $responseDate,
            'ip_address' => $this->faker->ipv4,
            'user_agent' => $this->faker->userAgent,
            'verified_at' => $this->faker->boolean(70) ? $this->faker->dateTimeBetween('-3 months', 'now') : null,
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => now(),
        ];
    }

    /**
     * Get a random vendor ID if vendors exist.
     */
    private function getRandomVendorId(): ?int
    {
        if (class_exists(Vendor::class) && Vendor::count() > 0) {
            return $this->faker->boolean(60) ? Vendor::inRandomOrder()->first()->id : null;
        }

        return null;
    }

    /**
     * Get a random user ID if users exist.
     */
    private function getRandomUserId(): ?int
    {
        if (class_exists(User::class) && User::count() > 0) {
            return $this->faker->boolean(80) ? User::inRandomOrder()->first()->id : null;
        }

        return null;
    }

    /**
     * Generate a vendor response to testimonial.
     */
    private function generateResponse(): string
    {
        $responses = [
            'Thank you so much for your wonderful review! We are delighted to hear about your positive experience. We look forward to serving you again!',
            'We appreciate your feedback! It\'s customers like you that make our work so rewarding. Thank you for choosing our services.',
            'Thank you for taking the time to share your experience. We are thrilled that you enjoyed our products! Your satisfaction is our priority.',
            'We\'re so glad to hear that you had a great experience with us! Thank you for your support and for being a valued customer.',
            'Thank you for your kind words! We strive to provide the best service possible and your feedback motivates us to keep improving.',
            'We appreciate your business and your feedback! It was a pleasure serving you. We hope to work with you again soon.',
            'Thank you for your wonderful review! We take pride in our work and it\'s great to know that our efforts are appreciated.',
            'We\'re honored to receive your positive feedback! Thank you for trusting us with your needs. We look forward to serving you again.',
            'Thank you for your support! Your satisfaction is our greatest reward. We appreciate you taking the time to share your experience.',
            'We\'re delighted to hear about your positive experience! Thank you for choosing us and for your valuable feedback.',
        ];

        return $this->faker->randomElement($responses);
    }

    /**
     * Generate a random author image (avatar).
     */
    private function generateAuthorImage(): ?string
    {
        // 85% chance to have an image, 15% chance to be null
        if ($this->faker->boolean(85)) {
            $avatarTypes = [
                'dicebear' => $this->generateDiceBearAvatar(),
                'ui-avatars' => $this->generateUIAvatars(),
                'placeholder' => $this->generatePlaceholderImage(),
            ];

            return $this->faker->randomElement($avatarTypes);
        }

        return null;
    }

    /**
     * Generate DiceBear avatar.
     */
    private function generateDiceBearAvatar(): string
    {
        $avatarStyles = [
            'adventurer',
            'adventurer-neutral',
            'avataaars',
            'big-ears',
            'big-smile',
            'bottts',
            'croodles',
            'fun-emoji',
            'icons',
            'identicon',
            'initials',
            'lorelei',
            'micah',
            'miniavs',
            'open-peeps',
            'personas',
            'pixel-art',
            'shapes',
            'thumbs',
        ];

        $style = $this->faker->randomElement($avatarStyles);
        $seed = $this->faker->firstName . ' ' . $this->faker->lastName;

        return "https://avatars.dicebear.com/api/{$style}/{$seed}.svg?background=random";
    }

    /**
     * Generate UI Avatars (initials-based).
     */
    private function generateUIAvatars(): string
    {
        $name = $this->faker->randomElement([
            'Abebe Kebede', 'Azeb Tadesse', 'Tekle Berhan',
            'Hana Wondimu', 'Mekdes Alemu', 'Dawit Haile'
        ]);

        $initials = $this->getInitials($name);
        $backgrounds = ['B88E3F', '4A90E2', 'E34D4D', '50C878', '9B59B6', 'F39C12', '1ABC9C', 'E67E22', '3498DB'];
        $background = $this->faker->randomElement($backgrounds);

        return "https://ui-avatars.com/api/?name={$initials}&background={$background}&color=fff&size=96&bold=true&length=2";
    }

    /**
     * Generate a placeholder image.
     */
    private function generatePlaceholderImage(): string
    {
        $placeholders = [
            'https://via.placeholder.com/96x96?text=User',
            'https://randomuser.me/api/portraits/women/' . rand(1, 99) . '.jpg',
            'https://randomuser.me/api/portraits/men/' . rand(1, 99) . '.jpg',
            'https://picsum.photos/id/' . rand(1, 100) . '/96/96',
        ];

        return $this->faker->randomElement($placeholders);
    }

    /**
     * Get initials from a name.
     */
    private function getInitials(string $name): string
    {
        $parts = explode(' ', $name);
        $initials = '';

        foreach ($parts as $part) {
            if (!empty($part)) {
                $initials .= strtoupper($part[0]);
            }
        }

        return substr($initials, 0, 2);
    }

    /**
     * Configure the factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Testimonial $testimonial) {
            // If you want to download and store images locally
            if ($testimonial->author_image && filter_var($testimonial->author_image, FILTER_VALIDATE_URL)) {
                $this->downloadAndStoreImage($testimonial);
            }

            // Set product relationship if applicable
            if ($this->faker->boolean(20) && class_exists(Product::class) && Product::count() > 0) {
                $testimonial->update([
                    'product_id' => Product::inRandomOrder()->first()->id,
                    'vendor_id' => null // Clear vendor if product is specified
                ]);
            }
        });
    }

    /**
     * Download and store image locally.
     */
    private function downloadAndStoreImage(Testimonial $testimonial): void
    {
        try {
            // Ensure directory exists
            $directory = storage_path('app/public/testimonials');
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Generate filename
            $filename = 'testimonial_' . $testimonial->id . '_' . time() . '.jpg';
            $path = 'testimonials/' . $filename;

            // Download image
            $imageContent = file_get_contents($testimonial->author_image);

            if ($imageContent !== false) {
                // Store image
                Storage::disk('public')->put($path, $imageContent);

                // Create thumbnail
                $this->createThumbnail($path);

                // Update the testimonial with local path
                $testimonial->update(['author_image' => $path]);
            }
        } catch (\Exception $e) {
            \Log::warning('Failed to download testimonial image: ' . $e->getMessage());
        }
    }

    /**
     * Create thumbnail for the image.
     */
    private function createThumbnail(string $path): void
    {
        try {
            $fullPath = storage_path('app/public/' . $path);

            if (file_exists($fullPath) && extension_loaded('gd')) {
                $thumbnailPath = 'testimonials/thumbnails/' . basename($path);
                $thumbnailFullPath = storage_path('app/public/' . $thumbnailPath);

                // Create thumbnail directory if needed
                $thumbnailDir = dirname($thumbnailFullPath);
                if (!file_exists($thumbnailDir)) {
                    mkdir($thumbnailDir, 0755, true);
                }

                // Create thumbnail using GD (simple resize)
                list($width, $height) = getimagesize($fullPath);
                $thumbWidth = 48;
                $thumbHeight = 48;

                $source = imagecreatefromstring(file_get_contents($fullPath));
                $thumbnail = imagecreatetruecolor($thumbWidth, $thumbHeight);

                imagecopyresampled($thumbnail, $source, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $width, $height);
                imagejpeg($thumbnail, $thumbnailFullPath, 80);

                imagedestroy($source);
                imagedestroy($thumbnail);
            }
        } catch (\Exception $e) {
            // Silently fail - thumbnails are optional
        }
    }

    /**
     * State for inactive testimonials.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }

    /**
     * State for active testimonials.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => true,
        ]);
    }

    /**
     * State for verified testimonials.
     */
    public function verified(): static
    {
        return $this->state(fn (array $attributes) => [
            'verified' => true,
            'verified_at' => now(),
        ]);
    }

    /**
     * State for unverified testimonials.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'verified' => false,
            'verified_at' => null,
        ]);
    }

    /**
     * State for featured testimonials.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'featured' => true,
        ]);
    }

    /**
     * State for high-rated testimonials (5 stars).
     */
    public function highRated(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => 5,
        ]);
    }

    /**
     * State for medium-rated testimonials (4-4.5 stars).
     */
    public function mediumRated(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => $this->faker->randomElement([4, 4.5]),
        ]);
    }

    /**
     * State for low-rated testimonials (1-3 stars).
     */
    public function lowRated(): static
    {
        return $this->state(fn (array $attributes) => [
            'rating' => $this->faker->randomElement([1, 1.5, 2, 2.5, 3]),
        ]);
    }

    /**
     * State for testimonials with images.
     */
    public function withImage(): static
    {
        return $this->state(fn (array $attributes) => [
            'author_image' => $this->generateAuthorImage(),
        ]);
    }

    /**
     * State for testimonials without images.
     */
    public function withoutImage(): static
    {
        return $this->state(fn (array $attributes) => [
            'author_image' => null,
        ]);
    }

    /**
     * State for testimonials with vendor response.
     */
    public function withResponse(): static
    {
        return $this->state(fn (array $attributes) => [
            'response' => $this->generateResponse(),
            'response_date' => now(),
        ]);
    }

    /**
     * State for testimonials without response.
     */
    public function withoutResponse(): static
    {
        return $this->state(fn (array $attributes) => [
            'response' => null,
            'response_date' => null,
        ]);
    }

    /**
     * State for vendor-specific testimonials.
     */
    public function forVendor($vendorId): static
    {
        return $this->state(fn (array $attributes) => [
            'vendor_id' => $vendorId,
            'product_id' => null,
        ]);
    }

    /**
     * State for product-specific testimonials.
     */
    public function forProduct($productId): static
    {
        return $this->state(fn (array $attributes) => [
            'product_id' => $productId,
            'vendor_id' => null,
        ]);
    }

    /**
     * State for user-specific testimonials.
     */
    public function forUser($userId): static
    {
        return $this->state(fn (array $attributes) => [
            'user_id' => $userId,
        ]);
    }

    /**
     * State for recent testimonials (last 30 days).
     */
    public function recent(): static
    {
        return $this->state(fn (array $attributes) => [
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ]);
    }

    /**
     * State for older testimonials (more than 6 months).
     */
    public function old(): static
    {
        return $this->state(fn (array $attributes) => [
            'created_at' => $this->faker->dateTimeBetween('-2 years', '-7 months'),
        ]);
    }
}
