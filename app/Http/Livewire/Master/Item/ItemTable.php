<?php

namespace App\Http\Livewire\Master\Item;

use App\Models\Item;
use Livewire\Component;

class ItemTable extends Component{
    public $items;
    protected $listeners = ['refresh_item_table' => 'refresh'];
    public function mount(){
        $this->items = Item::latest()->get();
    }
    public function refresh(){
        $this->items = Item::latest()->get();
    }
    public function render(){
        return view('livewire.master.item.item-table');
    }
}
