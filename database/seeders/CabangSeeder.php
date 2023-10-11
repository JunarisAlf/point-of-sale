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
            'id'        => 1,
            'name'      => 'Cabang Karya',
            'address'   => '-'
        ]);
        Cabang::create([
            'id'        => 2,
            'name'      => 'Cabang Paus',
            'address'   => '-'
        ]);
        Cabang::create([
            'id'        => 3,
            'name'      => 'Cabang Sukakarya',
            'address'   => '-'
        ]);
    }
}
