<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        $names = [
            'Abebe Kebede', 'Azeb Tadesse', 'Tekle Berhan', 
            'Hana Wondimu', 'Mekdes Alemu', 'Dawit Haile',
            'Sara Mohammed', 'Yonas Ayele', 'Girma Bekele'
        ];
        
        $roles = [
            'Local Business Owner', 'Customer', 'Event Planner',
            'Homeowner', 'Restaurant Owner', 'Teacher',
            'Hotel Manager', 'Tourist', 'Shop Owner'
        ];
        
        $testimonials = [
            'Vendora helped me find the best coffee supplier in Jimma. The quality is amazing!',
            'As a vendor, Vendora has connected me with so many customers. My business has grown tremendously!',
            'I found an amazing photographer through Vendora. The whole experience was seamless.',
            'The plumber I found on Vendora fixed my issue quickly at a fair price.',
            'Finding reliable food suppliers in Jimma has never been easier. Highly recommended!',
            'Great platform for connecting with local professionals. I use it for all my service needs.',
            'The customer support team is very helpful. They resolved my issue within hours.',
            'I love supporting local businesses through Vendora. It makes finding services so easy.',
            'Excellent selection of vendors. I found exactly what I was looking for.',
        ];

        return [
            'author_name' => $this->faker->randomElement($names),
            'author_role' => $this->faker->randomElement($roles),
            'content' => $this->faker->randomElement($testimonials),
            'is_active' => true,
            'sort_order' => $this->faker->numberBetween(1, 10),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at' => now(),
        ];
    }
}