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
        foreach ($categories as $key => $category) {
            // Generate 5 items for each category
            // Generate item name based on category name
            $itemName = 'Item ' . $category->name . ' ' . $key+1;
            $hasExpired = $faker->boolean;
            // Create the item

            // create barcode
            $barcode_12 = rand(111111111111, 999999999999);
            // get checksum number
            $barcode = strrev($barcode_12); // Reverse the barcode to simplify the calculation
            $barcodeLength = strlen($barcode);
            
            // Step 1: Assign odd/even positions and multiply
            $sum = 0;
            for ($i = 0; $i < $barcodeLength; $i++) {
                $digit = (int)$barcode[$i];
                $multiplier = ($i % 2 === 0) ? 3 : 1; // Changed multiplier for odd and even positions
                $sum += $digit * $multiplier;
            }
            // Step 2: Calculate the remainder
            $remainder = $sum % 10;
            // Step 3: Calculate the checksum digit
            $checksum = ($remainder === 0) ? 0 : 10 - $remainder;
            $barcode_13 = $barcode_12 . $checksum;

            Item::create([
                'barcode' => $barcode_13,
                'name' => $itemName,
                'category_id' => $category->id,
                'has_expired' => $hasExpired,
                'selling_price' => $faker->numberBetween(5000, 20000)
            ]);
        }
    }
}
