<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Item::create([
            'name'          => 'Item 1',
            'category_id'   => 1,
            'has_expired'   => true,
            'selling_price' => 12_000
        ]);
        Item::create([
            'name'          => 'Item 2',
            'category_id'   => 1,
            'has_expired'   => true,
            'selling_price' => 4_000
        ]);
        Item::create([
            'name'          => 'Item 3',
            'category_id'   => 1,
            'has_expired'   => true,
            'selling_price' =>5_000
        ]);
        Item::create([
            'name'          => 'Item 4',
            'category_id'   => 1,
            'has_expired'   => true,
            'selling_price' => 3_000
        ]);

        Item::create([
            'name'          => 'Item 5',
            'category_id'   => 2,
            'has_expired'   => true,
            'selling_price' => 22_000
        ]);
        Item::create([
            'name'          => 'Item 6',
            'category_id'   => 2,
            'has_expired'   => true,
            'selling_price' => 4_000
        ]);
        Item::create([
            'name'          => 'Item 7',
            'category_id'   => 2,
            'has_expired'   => true,
            'selling_price' =>5_000
        ]);

        Item::create([
            'name'          => 'Item 8',
            'category_id'   => 3,
            'has_expired'   => false,
            'selling_price' => 3_000
        ]);

        Item::create([
            'name'          => 'Item 9',
            'category_id'   => 3,
            'has_expired'   => false,
            'selling_price' => 33_000
        ]);
        Item::create([
            'name'          => 'Item 10',
            'category_id'   => 3,
            'has_expired'   => false,
            'selling_price' => 4_000
        ]);
    }
}
