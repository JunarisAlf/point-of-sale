<?php

namespace Database\Seeders;

use App\Models\Cabang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabangSeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        Cabang::create([
            'name'      => 'cabang 1',
            'address'   => 'Jl. Rajawali'
        ]);
        Cabang::create([
            'name'      => 'cabang 2',
            'address'   => 'Jl. Rajawali'
        ]);
        Cabang::create([
            'name'      => 'cabang 3',
            'address'   => 'Jl. Rajawali'
        ]);
    }
}
