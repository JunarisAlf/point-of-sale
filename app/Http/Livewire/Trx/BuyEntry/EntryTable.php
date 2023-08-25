<?php

namespace App\Http\Livewire\Trx\BuyEntry;

use App\Models\Buy;
use App\Models\Item;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EntryTable extends Component{
    public $items = [];
    protected $listeners = ['itemSubmit' => 'addItem'];
    public function addItem($item){
        $index = array_search($item['id'], array_column($this->items, 'id'));
        $itemName = Item::find($item['id'])->name;
        $item['name'] = $itemName;
        if($index !== false){
            $this->items[$index] = $item;
        }else{
            array_push($this->items, $item);
        }
        $this->updateGrandPrice();
    }
    public function removeItem($id){
        $index = array_search($id, array_column($this->items, 'id'));
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
                'is_paid'           => $buyData['is_paid'],
                'paid_date'         => $buyData['is_paid'] === "1" ? Carbon::now()->format('Y-m-d H:i:s') : null,
                'is_arrived'        => $buyData['is_arrived']
            ]);
            foreach ($this->items as $key => $item) {
                $buy->details()->create([
                    'item_id'       => $item['id'],
                    'satuan_id'     => $item['satuan_id'],
                    'qty_satuan'    => $item['converted_qty'], // real qty
                    'quantity'      => $item['quantity'],
                    'price'         => $item['price'],
                    'grand_price'   => $item['total_price']
                ]);
            }
            DB::commit();
            session()->forget('buy');
            $this->reset('items');
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('submited');
        }catch(Exception $e){
            DB::rollback();
            dd($e);
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.trx.buy-entry.entry-table');
    }
}
