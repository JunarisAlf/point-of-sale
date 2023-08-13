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
        KeyValue::create([
            'key'      => 'runing_text',
            'value'    => 'Lorem ipsum dolor sit amet consectetur adipisicing elit, Lorem ipsum dolor sit amet consectetur adipisicing elit.'
        ]);
        KeyValue::create([
            'key'      => 'login_text',
            'value'    => 'Tumbuhkanlah etos kerja yang tak kenal lelah, karena kesuksesan bukanlah hadiah instan, melainkan hasil dari usaha tanpa henti dan komitmen terhadap kemajuan pribadi.'
        ]);
    
    }
}
