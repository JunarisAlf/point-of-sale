<?php

namespace Database\Seeders;

use App\Models\Cabang;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $items = Item::all();
        $cabangs = Cabang::all();
        $currentDate = Carbon::now();
        $minDate = $currentDate->copy()->addYear()->getTimestamp();
        $maxDate = $currentDate->copy()->addYear(3)->getTimestamp();
    
        foreach ($items as $item) {
            foreach ($cabangs as $cb) {
                for ($i=0; $i < 2 ; $i++) { 
                    $currentDateLoop = $currentDate->copy();
                    $randomTimestamp = rand($minDate, $maxDate);
                    $randomDate = Carbon::createFromTimestamp($randomTimestamp);
                    $cb->stocks()->attach($item->id, [
                        'expired_date' => $randomDate->format('Y-m-d'),
                        'quantity' => rand(0, 100)
                    ]);
                }
            }
        }
    }
}
