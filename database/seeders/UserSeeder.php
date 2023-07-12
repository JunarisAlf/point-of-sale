<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username'      => 'master',
            'full_name'     => 'Fulan bin Fulan',
            'password'      => '123123',
            'role'          => 'master',
            'profile_image' => 'default_profile_img.png'
        ]);
        User::create([
            'username'      => 'admin',
            'full_name'     => 'Akun Admin',
            'password'      => '123123',
            'role'          => 'admin',
            'cabang_id'     => 1,
            'profile_image' => 'default_profile_img.png'

        ]);
        User::create([
            'username'      => 'gudang',
            'full_name'     => 'Akun Gudang',
            'password'      => '123123',
            'role'          => 'gudang',
            'cabang_id'     => 1,
            'profile_image' => 'default_profile_img.png'

        ]);
        User::create([
            'username'      => 'general',
            'full_name'     => 'Akun General',
            'password'      => '123123',
            'role'          => 'general',
            'cabang_id'     => 1,
            'profile_image' => 'default_profile_img.png'

        ]);
    }
}
