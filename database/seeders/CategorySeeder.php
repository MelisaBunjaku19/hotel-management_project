<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Travel'],
            ['name' => 'Luxury'],
            ['name' => 'Budget'],
            ['name' => 'Eco-Friendly'],
            ['name' => 'Technology'],
            ['name' => 'Destinations'],
            ['name' => 'Tips'],
        ];

        DB::table('categories')->insert($categories);
    }
}
