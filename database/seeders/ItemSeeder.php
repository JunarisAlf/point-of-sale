<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class ItemSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        
        $faker = Faker::create();
        // Get all categories
        $categories = Category::all();

        // Loop through each category
        foreach ($categories as $category) {
            // Generate 5 items for each category
            for ($i = 0; $i < 5; $i++) {
                // Generate item name based on category name
                $itemName = $faker->unique()->words(3, true);
                $itemName .= ' ' . $category->name;
                $hasExpired = $faker->boolean;
                // Create the item
                Item::create([
                    'name' => $itemName,
                    'category_id' => $category->id,
                    'has_expired' => $hasExpired,
                    'selling_price' => $faker->numberBetween(5000, 20000)
                ]);
            }
        }
    }
}
