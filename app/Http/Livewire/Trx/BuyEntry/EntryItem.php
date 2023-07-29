<?php

namespace App\Http\Livewire\Trx\BuyEntry;

use App\Models\Item;
use Livewire\Component;

class EntryItem extends Component {
    public $items = [];
    public $item_id, $price, $quantity, $total_price;
    protected $listeners = ['itemChange'];
    public function itemChange($id){
        $this->item_id = $id;
    }
    public function updated(){
        $price = $this->total_price / $this->quantity;
        $this->price = "Rp. " . number_format($price, 0, ',', '.');
    }
    public function submit(){
        $item = [
            'id'            => $this->item_id, 
            'quantity'      => $this->quantity, 
            'total_price'   => $this->total_price, 
            'price'         => $this->total_price / $this->quantity
        ];
        $this->emit('itemSubmit', $item);
        $this->dispatchBrowserEvent('itemSubmited');
        $this->reset();
    }
    public function mount(){
        $this->items = Item::all();
    }
    public function render() {
        return view('livewire.trx.buy-entry.entry-item');
    }
}
