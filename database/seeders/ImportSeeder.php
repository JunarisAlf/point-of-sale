<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Imports\ProductImport;
use App\Models\Cabang;
use App\Models\Item;
use Maatwebsite\Excel\Facades\Excel;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(new ProductImport, base_path('database/import/product.xlsx'));
        Excel::import(new ProductImport, base_path('database/import/produk-karya.xlsx'));
        Excel::import(new ProductImport, base_path('database/import/produk-paus.xlsx'));
        Excel::import(new ProductImport, base_path('database/import/produk-sukakarya.xlsx'));


        $cabangKarya        = Cabang::find(1);
        $cabangPaus         = Cabang::find(2);
        $cabangSukakarya    = Cabang::find(3);

        $dataKarya = Excel::toCollection([], base_path('database/import/produk-karya.xlsx'));
        $dataPaus = Excel::toCollection([], base_path('database/import/produk-paus.xlsx'));
        $dataSukakarya = Excel::toCollection([], base_path('database/import/produk-sukakarya.xlsx'));


        foreach($dataKarya[0] as $row){
            $item = Item::where('barcode', strVal($row[1]))->first();
            try{
                $cabangKarya->barang()->attach($item->id, [
                    'expired_date'  => null,
                    'buying_price'  => $row[3],
                    'quantity'      => $row[7]
                ]);
               echo 'Stock Saved ' .  $row[1] .  "\n";
            }catch(\Exception $e){
                echo 'FAIL'  . "\n";
            }
        }

        foreach($dataPaus[0] as $row){
            $item = Item::where('barcode', strval($row[1]))->first();
            try{
                $cabangPaus->barang()->attach($item->id, [
                    'expired_date'  => null,
                    'buying_price'  => $row[3],
                    'quantity'      => $row[7]
                ]);
               echo 'Stock Saved ' .  $row[1] .  "\n";
            }catch(\Exception $e){
                echo 'FAIL'  . "\n";
            }
        }

        foreach($dataSukakarya[0] as $row){
            $item = Item::where('barcode', strval($row[1]))->first();
            try{
                $cabangSukakarya->barang()->attach($item->id, [
                    'expired_date'  => null,
                    'buying_price'  => $row[3],
                    'quantity'      => $row[7]
                ]);
               echo 'Stock Saved ' .  $row[1] .  "\n";
            }catch(\Exception $e){
                echo 'FAIL'  . "\n";
            }
        }

        $items = Item::all();
        foreach($items as $item){
            $item->prices()->create(['quantity' => 1, 'price' => $item->selling_price , 'percentage' => 0]);
            $item->qtyConverters()->create([
                'name'      => 'pcs',
                'quantity'  => 1
            ]);
        }

    }
}
