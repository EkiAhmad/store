<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        $category = ['Snack', 'Drink', 'Vegetable', 'Fruits', 'Beverages'];
        for ($i=0; $i < count($category); $i++) { 
            Category::create([
                'name' => $category[$i],
            ]);
        }
    }
}
