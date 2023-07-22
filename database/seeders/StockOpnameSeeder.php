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
            $item->opnames()->create([
                'date'      => $dateNow,
                'quantity'  => $item->quantity + rand(0, 3),
                'user_id'   => 3
            ]);
        }
       
    }
}
