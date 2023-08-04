<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MultiPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        $items = Item::all();
        foreach ($items as $key => $item) {
            $price = $item->selling_price;
            $price_1 = $price * 0.95;
            $price_2 = $price * 0.9;
            $price_3 = $price * 0.8;
            $item->prices()->createMany([
                ['quantity' => 20, 'price' => $price_1 ,'percentage' => 5.0],
                ['quantity' => 50, 'price' => $price_2 ,'percentage' => 10.0],
                ['quantity' => 100, 'price' => $price_3 ,'percentage' => 20.0],
            ]);
        }
    }
}
