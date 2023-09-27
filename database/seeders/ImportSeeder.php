<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new ProductImport, base_path('database/import/product.xlsx'));
    }
}
