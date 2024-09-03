<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'room_title' => 'Deluxe Bed Room',
                'description' => 'A spacious room with luxurious furnishings.',
                'price' => 200.00,
                'wifi' => 'Free Wi-Fi 1, Free Wi-Fi 2',
                'room_type' => 'deluxe',
                'image' => 'room1.jpg'
            ],
            [
                'room_title' => 'Standard Single Room',
                'description' => 'A cozy single room with all basic amenities.',
                'price' => 100.00,
                'wifi' => 'Free Wi-Fi 1',
                'room_type' => 'single',
                'image' => 'room2.jpg'
            ],
            [
                'room_title' => 'Luxury Suite',
                'description' => 'A high-end suite with premium features and a city view.',
                'price' => 350.00,
                'wifi' => 'Free Wi-Fi 1, Free Wi-Fi 2, Premium Wi-Fi',
                'room_type' => 'suite',
                'image' => 'room3.jpg'
            ],
            [
                'room_title' => 'Family Room',
                'description' => 'A spacious room perfect for families with kids.',
                'price' => 250.00,
                'wifi' => 'Free Wi-Fi 1, Free Wi-Fi 2',
                'room_type' => 'family',
                'image' => 'room4.jpg'
            ],
            [
                'room_title' => 'Business Room',
                'description' => 'A room designed for business travelers with a work desk and high-speed internet.',
                'price' => 180.00,
                'wifi' => 'Free Wi-Fi 1, High-Speed Wi-Fi',
                'room_type' => 'business',
                'image' => 'room5.jpg'
            ],
            [
                'room_title' => 'Economy Room',
                'description' => 'An affordable room with essential amenities.',
                'price' => 80.00,
                'wifi' => 'Free Wi-Fi 1',
                'room_type' => 'economy',
                'image' => 'room6.jpg'
            ],
            [
                'room_title' => 'Penthouse Suite',
                'description' => 'A luxurious penthouse suite with stunning city views and premium amenities.',
                'price' => 500.00,
                'wifi' => 'Free Wi-Fi 1, Premium Wi-Fi, High-Speed Wi-Fi',
                'room_type' => 'penthouse',
                'image' => 'room7.jpg'
            ],
            [
                'room_title' => 'Standard Double Room',
                'description' => 'A comfortable double room with two beds and basic amenities.',
                'price' => 150.00,
                'wifi' => 'Free Wi-Fi 1',
                'room_type' => 'double',
                'image' => 'room8.jpeg'
            ],
            [
                'room_title' => 'Standard Double Room',
                'description' => 'A comfortable double room with two beds and basic amenities.',
                'price' => 150.00,
                'wifi' => 'Free Wi-Fi 1',
                'room_type' => 'double',
                'image' => 'room9.jpeg'
            ],
        ]);
    }
}
