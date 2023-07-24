<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Supplier::create([
            'name'      => 'Jaya Merdeka',
            'telp'      => '082282823232',
            'address'   => 'Jl. Soekarno Hatta No. 65',
            'rekening'  => json_encode([ 'BCA 123123123123', 'BRI 3232323232'])
        ]);

        Supplier::create([
            'name'      => 'Berkah Mulia',
            'telp'      => '082282823333',
            'address'   => 'Jl. Ahmad Dahlam',
            'rekening'  => json_encode([ 'BCA 123123123123', 'BRI 3232323232'])
        ]);
    }
}
