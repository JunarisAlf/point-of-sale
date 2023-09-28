<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\KeyValue;
use App\Models\MultiPrice;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CabangSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(ItemSeeder::class);
        // $this->call(StockSeeder::class);
        // $this->call(StockOpnameSeeder::class);
        // $this->call(SupplierSeeder::class);
        // $this->call(BuySeeder::class);
        // $this->call(MultiPriceSeeder::class);
        // $this->call(CustomerSeeder::class);
        $this->call(KeyValueSeeder::class);

    }
}
