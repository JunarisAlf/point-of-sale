<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Imports\ProductImport;
use App\Models\Cabang;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Satuan;
use App\Models\Supplier;
use Maatwebsite\Excel\Facades\Excel;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Import Satuan TEMP
        $dataSatuan = Excel::toCollection([], base_path('database/import/satuan.xlsx'));
        foreach($dataSatuan[0] as $row){
            try{
                Satuan::create([
                    'id'        => $row[0],
                    'name'      => $row[1]
                ]);
                echo $row[1] . "SUCCESS" .  "\n";
            }catch(\Exception $e){
                echo  $row[1] . $e->getMessage() . "\n";
            }
        }
        $dataCategory = Excel::toCollection([], base_path('database/import/pos_kategori.xlsx'));
        foreach($dataCategory[0] as $row){
            try{
                Category::create([
                    'id'        => $row[0],
                    'name'      => $row[1]
                ]);
                echo $row[1] . "SUCCESS" .  "\n";
            }catch(\Exception $e){
                echo  $row[1] . $e->getMessage() . "\n";
            }
        }

        // IMPORT ITEM
        Excel::import(new ProductImport, base_path('database/import/produk_karya.xlsx'));
        Excel::import(new ProductImport, base_path('database/import/produk_paus.xlsx'));
        Excel::import(new ProductImport, base_path('database/import/produk_sukakarya.xlsx'));

        // IMPORT STOK
        $cabangKarya        = Cabang::find(1);
        $cabangPaus         = Cabang::find(2);
        $cabangSukakarya    = Cabang::find(3);

        $dataKarya = Excel::toCollection([], base_path('database/import/produk_karya.xlsx'));
        $dataPaus = Excel::toCollection([], base_path('database/import/produk_paus.xlsx'));
        $dataSukakarya = Excel::toCollection([], base_path('database/import/produk_sukakarya.xlsx'));

        foreach($dataKarya[0] as $row){
            $item = Item::where('barcode', strVal($row[1]))->first();
            try{
                $cabangKarya->barang()->attach($item->id, [
                    'expired_date'  => null,
                    'buying_price'  => intval($row[3]),
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
                    'buying_price'  => intval($row[3]),
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
                    'buying_price'  => intval($row[3]),
                    'quantity'      => $row[7]
                ]);
               echo 'Stock Saved ' .  $row[1] .  "\n";
            }catch(\Exception $e){
                echo 'FAIL'  . "\n";
            }
        }



        // IMPORT MULTIPRICE AND QTY CONVERTER
        $dataMultiPrices = Excel::toCollection([], base_path('database/import/multiprices.xlsx'));
        foreach($dataMultiPrices[0] as $row){
            try{
                $item = Item::where('barcode', $row[1])->first();
                $actualPrice = safeDivision(intval($row[5]) ,intval($row[2]));
                if($item !== null){
                    $item->prices()->create(
                        [
                            'quantity' => intval($row[2]),
                            'price' => $actualPrice ,
                            'percentage' => 100 - safeDivision($actualPrice * 100, $item->selling_price )
                        ]
                    );
                    $id_satuan = $row[3];
                    $item->qtyConverters()->create([
                        'quantity'  => intval($row[2]),
                        'name'      => Satuan::find($id_satuan)->name
                    ]);
                }else{
                    echo $row[1] . "EXISTS" .  "\n";
                }
            }catch(\Exception $e){
                echo $item->selling_price . " | " . $actualPrice . " | " . 100 - safeDivision($actualPrice * 100, $item->selling_price ) . "\n";
                // echo  $row[1] . $e->getMessage() . "\n";
            }
        }


        // IMPORT SUPPLIER
        $dataSupplier = Excel::toCollection([], base_path('database/import/supplier_1.xlsx'));
        foreach($dataSupplier[0] as $row){
            try{
                $check = Supplier::where('name', $row[1])->exists();
                if(!$check){
                    Supplier::create([
                        'name'      => $row[1],
                        'telp'      => $row[2],
                        'address'   => '-'
                    ]);
                    echo $row[1] . "SUCCESS" .  "\n";
                }else{
                    echo $row[1] . "EXISTS" .  "\n";
                }
            }catch(\Exception $e){
                echo  $row[1] . $e->getMessage() . "\n";
            }
        }
        $dataSupplier = Excel::toCollection([], base_path('database/import/supplier_2.xlsx'));
        foreach($dataSupplier[0] as $row){
            try{
                $check = Supplier::where('name', $row[1])->exists();
                if(!$check){
                    Supplier::create([
                        'name'      => $row[1],
                        'telp'      => $row[2],
                        'address'   => '-'
                    ]);
                    echo $row[1] . "SUCCESS" .  "\n";
                }else{
                    echo $row[1] . "EXISTS" .  "\n";
                }
            }catch(\Exception $e){
                echo  $row[1] . $e->getMessage() . "\n";
            }
        }
        $dataSupplier = Excel::toCollection([], base_path('database/import/supplier_3.xlsx'));
        foreach($dataSupplier[0] as $row){
            try{
                $check = Supplier::where('name', $row[1])->exists();
                if(!$check){
                    Supplier::create([
                        'name'      => $row[1],
                        'telp'      => $row[2],
                        'address'   => '-'
                    ]);
                    echo $row[1] . "SUCCESS" .  "\n";
                }else{
                    echo $row[1] . "EXISTS" .  "\n";
                }
            }catch(\Exception $e){
                echo  $row[1] . $e->getMessage() . "\n";
            }
        }

        // IMPORT CUSTOMER
        $dataKonsumen = Excel::toCollection([], base_path('database/import/konsumen_1.xlsx'));
        foreach($dataKonsumen[0] as $row){
            try{
                $check = Customer::where('name', $row[1])->exists();
                if(!$check){
                    Customer::create([
                        'name'      => $row[1],
                        'wa'        => $row[3] == null ? '-' : $row[3],
                        'address'   => $row[2] == null ? '-' : $row[2],
                        'gender'    => 'male'
                    ]);
                    echo $row[1] . "SUCCESS" .  "\n";
                }else{
                    echo $row[1] . "EXISTS" .  "\n";
                }
            }catch(\Exception $e){
                echo  $row[1] . $e->getMessage() . "\n";
            }
        }
        $dataKonsumen = Excel::toCollection([], base_path('database/import/konsumen_2.xlsx'));
        foreach($dataKonsumen[0] as $row){
            try{
                $check = Customer::where('name', $row[1])->exists();
                if(!$check){
                    Customer::create([
                        'name'      => $row[1],
                        'wa'        => $row[3] == null ? '-' : $row[3],
                        'address'   => $row[2] == null ? '-' : $row[2],
                        'gender'    => 'male'
                    ]);
                    echo $row[1] . "SUCCESS" .  "\n";
                }else{
                    echo $row[1] . "EXISTS" .  "\n";
                }
            }catch(\Exception $e){
                echo  $row[1] . $e->getMessage() . "\n";
            }
        }
        $dataKonsumen = Excel::toCollection([], base_path('database/import/konsumen_3.xlsx'));
        foreach($dataKonsumen[0] as $row){
            try{
                $check = Customer::where('name', $row[1])->exists();
                if(!$check){
                    Customer::create([
                        'name'      => $row[1],
                        'wa'        => $row[3] == null ? '-' : $row[3],
                        'address'   => $row[2] == null ? '-' : $row[2],
                        'gender'    => 'male'
                    ]);
                    echo $row[1] . "SUCCESS" .  "\n";
                }else{
                    echo $row[1] . "EXISTS" .  "\n";
                }
            }catch(\Exception $e){
                echo  $row[1] . $e->getMessage() . "\n";
            }
        }
    }
}
