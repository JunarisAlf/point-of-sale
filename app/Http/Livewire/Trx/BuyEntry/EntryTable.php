<?php

namespace App\Http\Livewire\Trx\BuyEntry;

use App\Models\Buy;
use App\Models\Cash;
use App\Models\Item;
use App\Models\StockItem;
use App\Models\Supplier;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EntryTable extends Component{
    public $items = [];
    protected $listeners = ['itemSubmit' => 'addItem'];
    public function addItem($item){
        try{
            $index = custom_array_search($this->items, $item['id']);
            $itemName = Item::find($item['id'])->name;
            $item['name'] = $itemName;
            if($index !== false){
                $this->items[$index] = $item;
            }else{
                array_push($this->items, $item);
            }
            $this->updateGrandPrice();
        }catch(\Exception $e){}

    }
    public function removeItem($id){
        $index = custom_array_search($this->items, $id);
        unset($this->items[$index]);
        $this->updateGrandPrice();
    }

    public function updateGrandPrice(){
        $totalSum = array_reduce($this->items, function ($carry, $item) {
            return $carry + $item['total_price'];
        }, 0);
        $this->emit('grandPriceUpdate', $totalSum);
    }

    public function store(){
        $buyData = session()->get('buy');
        DB::beginTransaction();
        try{
            $buy = Buy::create([
                'supplier_id'       => $buyData['supplier_id'],
                'cabang_id'         => $buyData['cabang_id'],
                'created_at'        => $buyData['date'],
                'note'              => $buyData['note'],
                'is_paid'           => $buyData['is_paid'],
                'paid_date'         => $buyData['is_paid'] === "1" ? Carbon::now()->format('Y-m-d H:i:s') : null,
                'is_arrived'        => $buyData['is_arrived'],
            ]);
            $total = 0;
            foreach ($this->items as $key => $item) {
                $buy->details()->create([
                    'item_id'       => $item['id'],
                    'satuan_id'     => $item['satuan_id'],
                    'qty_satuan'    => $item['converted_qty'], // real qty/qty satuan terkecil
                    'quantity'      => $item['quantity'],
                    'price'         => $item['price'],
                    'grand_price'   => $item['total_price'],
                    'expired_date'  => $item['expired_date']
                ]);
                $total += $item['total_price'];

                $item_db = Item::find($item['id']);

                $oldQtySum = $item_db->barang()->where('cabang_id', $buyData['cabang_id'])->sum('quantity');
                $oldPrice = $item_db->barang()->where('cabang_id', $buyData['cabang_id'])->avg('buying_price') ?? 0;
                $oldModalSum = $oldQtySum * $oldPrice;
                $addedModalSum = $item['total_price'];
                $newPrice = safeDivision($oldModalSum + $addedModalSum, $oldQtySum + $item['converted_qty']);

                $has_expired = $item_db->has_expired;
                if($has_expired){
                    $expired_date = Carbon::parse($item['expired_date'])->format('Y-m-d');
                    $stockItem = StockItem::where('item_id', $item_db->id)
                        ->where('cabang_id', $buyData['cabang_id'])
                        ->whereDate('expired_date', $expired_date)->first();

                    //if null make new one
                    if($stockItem == null){
                        $item_db->barang()->attach($buyData['cabang_id'], [
                            'expired_date'  => $expired_date,
                            'buying_price'  => $newPrice,
                            'quantity'      => $item['converted_qty']
                        ]);
                    }else{
                        //else update exists
                        $stockItem->quantity += intval($item['converted_qty']);
                        $stockItem->buying_price = $newPrice;
                        $stockItem->save();
                    }
                    //update price for same item with different expired date
                    $item_db->barang()->where('cabang_id', $buyData['cabang_id'])->update(['buying_price' => $newPrice]);
                }else{
                    $stockItem = StockItem::where('item_id', $item_db->id)
                        ->where('cabang_id', $buyData['cabang_id'])
                        ->where('expired_date', null)->first();
                    $stockItem->quantity    += intval($item['converted_qty']);
                    $stockItem->buying_price = $newPrice;
                    $stockItem->save();
                }
            }
            if($buyData['is_paid']){
                Cash::create([
                    'cabang_id'     => $buyData['cabang_id'],
                    'date'          => Carbon::now()->format('Y-m-d H:i:s'),
                    'flow'          => 'out',
                    'total'         => $total,
                    'name'          => "Pembelian Dari Supplier " . @Supplier::find(@$buyData['supplier_id'])->name
                ]);
            }
            DB::commit();
            session()->forget('buy');
            $this->reset('items');
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('submited');
        }catch(Exception $e){
            DB::rollback();
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.trx.buy-entry.entry-table');
    }
}
