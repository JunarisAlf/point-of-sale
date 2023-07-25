<?php

namespace Database\Seeders;

use App\Models\Buy;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $buy = Buy::create([
            'supplier_id'       => 1,
            'cabang_id'         => 1,
            'date'              => Carbon::now()->format('Y-m-d'),
            'is_paid'           => false,
            'is_arrived'        => false
        ]);

        $buy->details()->createMany ([
            [
                'item_id'       => 1,
                'quantity'      => 100,
                'price'         => 10_000,
                'grand_price'   => 100_000
            ],
            [
                'item_id'       => 2,
                'quantity'      => 50,
                'price'         => 5_000,
                'grand_price'   => 50_000
            ],
            [
                'item_id'       => 3,
                'quantity'      => 200,
                'price'         => 15_000,
                'grand_price'   => 300_000
            ]
        ]);
        $buy = Buy::create([
            'supplier_id'       => 2,
            'cabang_id'         => 1,
            'date'              => Carbon::now()->subDays(3)->format('Y-m-d'),
            'is_paid'           => false,
            'is_arrived'        => false
        ]);

        $buy->details()->createMany ([
            [
                'item_id'       => 3,
                'quantity'      => 100,
                'price'         => 10_000,
                'grand_price'   => 100_000
            ],
            [
                'item_id'       => 4,
                'quantity'      => 50,
                'price'         => 5_000,
                'grand_price'   => 50_000
            ],
            [
                'item_id'       => 5,
                'quantity'      => 100,
                'price'         => 15_000,
                'grand_price'   => 150_000
            ]
        ]);
    }
}
