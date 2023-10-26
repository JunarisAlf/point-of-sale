<?php

namespace App\Http\Livewire\Gudang\Retur;

use App\Models\Item;
use Exception;
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
    }
    public function removeItem($id){
        $index = array_search($id, array_column($this->items, 'id'));
        unset($this->items[$index]);
    }


    public function store(){
        $this->emit('validateMetaInfo', $this->items);
    }
    public function render(){
        return view('livewire.gudang.retur.entry-table');
    }
}
