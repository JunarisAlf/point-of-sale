<?php

namespace Database\Seeders;

use App\Models\KeyValue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeyValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        KeyValue::create([
            'key'      => 'toko_logo',
            'value'    => 'logo.png'
        ]);
        KeyValue::create([
            'key'      => 'toko_name',
            'value'    => 'JUNA POS'
        ]);
        KeyValue::create([
            'key'      => 'toko_wa',
            'value'    => '082284393018'
        ]);
        KeyValue::create([
            'key'      => 'toko_address',
            'value'    => 'Jl. Ahmad Dahlan, Sukajadi, Pekanbaru'
        ]);
        KeyValue::create([
            'key'      => 'toko_email',
            'value'    => 'junaris@gmail.com'
        ]);
    
    }
}
