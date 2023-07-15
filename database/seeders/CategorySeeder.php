<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder{
    /**
     * Run the database seeds.
     */
    public function run(): void{
        $categories = [
            ['name' => 'Alat Pemanggang'],
            ['name' => 'Alat Pengaduk'],
            ['name' => 'Alat Pengukur'],
            ['name' => 'Alat Pencampur'],
            ['name' => 'Bahan Kue Dasar'],
            ['name' => 'Bahan Kue Manis'],
            ['name' => 'Bahan Kue Gurih'],
            ['name' => 'Perangkat Penyajian'],
            ['name' => 'Pewarna Kue'],
            ['name' => 'Pewangi Kue'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
