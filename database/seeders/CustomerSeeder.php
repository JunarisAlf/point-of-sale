<?php

namespace Database\Seeders;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $cus = Customer::create([
            'name'      => 'UMUM',
            'gender'    => 'male',
            'wa'        => '-',
            'address'   => '-'
        ]);
        $trx = $cus->trxs()->create([
            'cabang_id'         => 1,
            'is_paid'           => true,
            'date'              => Carbon::now()->format('Y-m-d H:i:s'),
            'sub_total'         => 45_000,
            'total_discount'    => 5000,
            'total'             => 40000
        ]);
        $trx->details()->create([
            'item_id'       => 1,
            'quantity'      => 3,
            'price'         => 15_000,
            'discount'      => 5000,
            'grand_price'   => 45_000
        ]);
        Customer::create([
            'name'      => 'Customer 1',
            'gender'    => 'female',
            'wa'        => '6282245456465',
            'address'   => 'Jl. Ahmad Dahlan No 5, Kampung Melayu, Sukajadi'
        ]);

        Customer::create([
            'name'      => 'Customer 2',
            'gender'    => 'male',
            'wa'        => '6282245456432',
            'address'   => 'Jl. Kutilang Darat No 5, Kampung Melayu, Sukajadi'
        ]);
    }
}
