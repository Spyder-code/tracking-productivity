<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Books',
            'Business',
            'Developer Tools',
            'Social',
            'Food and Dining',
            'Government and Politics',
            'Health and Fitness',
            'Kids and Family',
            'Lifestyle',
            'Multimedia Design',
            'Music',
            'Navigation and Maps',
            'News and Weather',
            'Browser'
        ];

        foreach ($data as $item ) {
            Category::create([
                'name' => $item
            ]);
        }
    }
}
