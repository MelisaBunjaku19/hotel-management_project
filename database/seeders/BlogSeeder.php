<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    public function run()
    {
        // Blog posts data
        $blogPosts = [
            [
                'title' => 'Hotel Management Tips',
                'excerpt' => 'Essential tips for effective hotel management.',
                'content' => 'Discover essential tips for effective hotel management. Learn how to optimize operations, manage staff, and enhance guest experiences for a successful hotel business.',
                'image' => 'hotel_management_tips.jpg',
            ],
            [
                'title' => 'Travel Tips for 2024',
                'excerpt' => 'Top travel tips to make your next trip unforgettable.',
                'content' => 'Explore our top travel tips to make your next trip unforgettable. From packing essentials to finding local attractions, our guide ensures you have everything you need for a smooth journey.',
                'image' => 'travel_tips_2024.jpg',
            ],
            [
                'title' => 'Luxury Hotel Stays',
                'excerpt' => 'Experience the luxury of top-rated hotels.',
                'content' => 'Experience the luxury of staying in a top-rated hotel. Learn about the best amenities, services, and features offered by luxury hotels to ensure an exceptional stay.',
                'image' => 'luxury_hotel_stays.jpg',
            ],
            [
                'title' => 'Budget Travel Hacks',
                'excerpt' => 'Save money while traveling with these budget-friendly tips.',
                'content' => 'Discover budget travel hacks to save money on your trips. From finding affordable accommodations to scoring deals on flights, these tips will help you travel without breaking the bank.',
                'image' => 'budget_travel_hacks.jpg',
            ],
            [
                'title' => 'Eco-Friendly Hotel Practices',
                'excerpt' => 'How hotels are going green and what you can do.',
                'content' => 'Learn about eco-friendly practices being adopted by hotels to reduce their environmental impact. Discover how you can support sustainable tourism and stay at green-certified hotels.',
                'image' => 'eco_friendly_hotel_practices.jpg',
            ],
            [
                'title' => 'The Future of Hospitality',
                'excerpt' => 'Trends shaping the future of the hospitality industry.',
                'content' => 'Explore the trends shaping the future of hospitality. From technological innovations to changing guest expectations, stay ahead of the curve with insights into the future of the industry.',
                'image' => 'future_of_hospitality.png',
            ],
            [
                'title' => 'Top Destinations for 2024',
                'excerpt' => 'Must-visit destinations for your next vacation.',
                'content' => 'Get inspired by our list of top travel destinations for 2024. Whether you’re looking for adventure, relaxation, or cultural experiences, these destinations offer something for every type of traveler.',
                'image' => 'top_destinations_2024.jpg',
            ],
            [
                'title' => 'How to Choose the Perfect Hotel',
                'excerpt' => 'Tips for selecting the ideal hotel for your stay.',
                'content' => 'Find out how to choose the perfect hotel for your needs. Consider factors like location, amenities, and guest reviews to ensure a comfortable and enjoyable stay.',
                'image' => 'choose_perfect_hotel.jpeg',
            ],
            [
                'title' => 'Digital Nomad Lifestyle',
                'excerpt' => 'How to thrive as a digital nomad while traveling.',
                'content' => 'Explore the digital nomad lifestyle and learn how to thrive while working remotely from various destinations. Tips on balancing work and travel, finding coworking spaces, and maintaining productivity.',
                'image' => 'blog0.jpg',
            ],
            [
                'title' => 'Best Airbnb Experiences',
                'excerpt' => 'Unique Airbnb experiences you should try.',
                'content' => 'Discover the best Airbnb experiences around the world. From cooking classes to guided tours, these unique experiences will enhance your travels and create unforgettable memories.',
                'image' => 'blog1.jpg',
            ],
            [
                'title' => 'Hotel Check-In Tips',
                'excerpt' => 'How to make the hotel check-in process smoother.',
                'content' => 'Learn tips to make your hotel check-in process smoother and more efficient. Avoid common pitfalls and ensure a hassle-free start to your stay.',
                'image' => 'blog2.jpg',
            ],
            [
                'title' => 'Essential Travel Gear',
                'excerpt' => 'Must-have gear for every traveler.',
                'content' => 'Check out our list of essential travel gear that every traveler should have. From backpacks to travel accessories, these items will make your trips more comfortable and convenient.',
                'image' => 'blog3.jpg',
            ],
            [
                'title' => 'How to Handle Travel Delays',
                'excerpt' => 'Strategies for managing travel delays and disruptions.',
                'content' => 'Travel delays can be stressful. Learn strategies to handle delays and disruptions effectively, including how to stay calm, manage your time, and make the most of unexpected downtime.',
                'image' => 'blog4.jpg',
            ],
            [
                'title' => 'Best Sustainable Hotels',
                'excerpt' => 'Top eco-friendly hotels to stay in.',
                'content' => 'Discover the best sustainable hotels that prioritize environmental responsibility. Learn about green certifications, eco-friendly practices, and how these hotels contribute to sustainable tourism.',
                'image' => 'blog5.jpg',
            ],
        ];

        // Insert blog posts into the database
        DB::table('blogs')->insert($blogPosts);
    }
}
