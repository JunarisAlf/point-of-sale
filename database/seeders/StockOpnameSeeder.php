<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\StockItem;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockOpnameSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $items = StockItem::all();
        $dateNow = Carbon::now()->format('Y-m-d');
        foreach ($items as $key => $item) {
            $diff =  rand(0, 3);
            $item->opnames()->create([
                'date'          => $dateNow,
                'old_quantity'  => $item->quantity,
                'quantity'      => $item->quantity + $diff,
                'diff_price'    => $diff * $item->buying_price,
                'user_id'       => 3
            ]);
        }

    }
}
