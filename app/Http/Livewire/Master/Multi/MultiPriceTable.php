<?php

namespace App\Http\Livewire\Master\Multi;

use App\Models\Cabang;
use App\Models\Item;
use App\Models\QtyConverter;
use Livewire\Component;

class MultiPriceTable extends Component{
    public $item_id, $itemSelect;
    protected $listeners = ['itemSelectChange', 'refresh_multiprice_table' => 'refresh'];
    public function itemSelectChange($id){
        $this->item_id = $id;
        $this->itemMulti = Item::where('id', $this->item_id)->with('prices')->first();
        $this->qtyConverter = QtyConverter::where('item_id', $this->item_id)->orderBy('quantity', 'ASC')->get();
    }
    public $itemMulti = [];
    public $qtyConverter = [];
    public function mount(){
        $this->itemSelect = Item::all(['id', 'name']);
        $this->itemMulti = Item::where('id', $this->item_id)->with('prices')->first();
        $this->qtyConverter = QtyConverter::where('item_id', $this->item_id)->orderBy('quantity', 'ASC')->get();
        // dd($this->qtyConverter);

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

    public function openCreateQtyConv($item_id){
        $this->emit('openQtyConv', $item_id);
    }
    public function openEditQtyConvModal($id){
        $this->emit('openEditQtyConvModal', $id);
    }
    public function openDeleteQtyConvModal($id){
        $this->emit('openDeleteQtyConvModal', $id);
    }
    public function refresh(){
        $this->mount();


    }
    public function render(){
        return view('livewire.master.multi.multi-price-table');
    }
}
