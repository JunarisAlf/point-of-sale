<?php

namespace App\Http\Livewire\Trx\SellEntryOnline;

use App\Models\Item;
use Exception;
use Livewire\Component;

class EntryTable extends Component{
    public $items = [];
    protected $listeners = ['itemSubmit' => 'addItem'];
    public function addItem($item){
        $index = custom_array_search($this->items,$item['id']);
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
        $index = custom_array_search($this->items, $id);
        unset($this->items[$index]);
        $this->updateGrandPrice();
    }

    public function updateGrandPrice(){
        $totalSum = array_reduce($this->items, function ($carry, $item) {
            return $carry + $item['total_price'];
        }, 0);
        $subTotal = array_reduce($this->items, function ($carry, $item) {
            return $carry + ($item['converted_qty'] *  $item['price']) ;
        }, 0);

        $this->emit('grandPriceUpdate', compact('totalSum'));
    }

    public function store(){
        $this->emit('validateMetaInfo', $this->items);
    }
    public function render(){
        return view('livewire.trx.sell-entry-online.entry-table');
    }
}
