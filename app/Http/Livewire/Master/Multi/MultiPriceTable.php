<?php

namespace App\Http\Livewire\Master\Multi;

use App\Models\Cabang;
use App\Models\Item;
use Livewire\Component;

class MultiPriceTable extends Component{
    public $item_id, $itemSelect;
    protected $listeners = ['itemSelectChange', 'refresh_multiprice_table' => 'refresh'];
    public function itemSelectChange($id){
        $this->item_id = $id;
        $this->itemMulti = Item::where('id', $this->item_id)->with('prices')->first();
    }
    public $itemMulti = [];
    public function mount(){
        $this->itemSelect = Item::all(['id', 'name']);
        $this->itemMulti = Item::where('id', $this->item_id)->with('prices')->first();
    }
    public function openCreateModal($item_id){
        $this->emit('openCreateModal', $item_id);
    }
    public function openEditModal($id){
        $this->emit('openEditModal', $id);
    }
    public function openDeleteModal($id){
        $this->emit('openDeleteModal', $id);
    }
    public function refresh(){
        $this->mount();
    }
    public function render(){
        return view('livewire.master.multi.multi-price-table');
    }
}
