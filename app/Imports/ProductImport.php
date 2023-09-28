<?php
namespace App\Imports;

use App\Models\Cabang;
use App\Models\Category;
use App\Models\Item;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductImport implements ToCollection
{
    public function collection(Collection $rows) {
        $category = Category::create([
            'name'  => 'Produk'
        ]);
        foreach ($rows as $row)  {
            try{
                $item = Item::create([
                    'barcode'       => $row[1],
                    'name'          => $row[2],
                    'has_expired'   => false,
                    'selling_price' => $row[5],
                    'category_id'   => $category->id
               ]);
               echo 'Imported ' .  $row[1] . 'SUCCESS!' . "\n";
            }catch (\Exception $e) {
                echo "FAIL";
                continue;
            }
        }




    }
}
