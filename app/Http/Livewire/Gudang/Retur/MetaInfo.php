<?php

namespace App\Http\Livewire\Gudang\Retur;

use App\Models\Cabang;
use App\Models\Customer;
use App\Models\Supplier;
use Livewire\Component;

class MetaInfo extends Component{
    public $user;
    public $cabangSelect, $cabang_id, $note, $type = 'ke-supplier', $suppliers, $supplier_id, $customers, $customer_id;
    public $metainfo;
    protected $listeners = ['validateMetaInfo', 'supplierChange', 'customerChange'];
    public function mount(){
        $this->cabangSelect = Cabang::all();
        $this->suppliers = Supplier::all();
        $this->customers = Customer::all();
        session()->put('type', $this->type);
    }
    public function updated(){
        $this->emit('render-select2', $this->supplier_id, $this->customer_id);
    }
    public function updatedNote(){
        session()->put('note', $this->note);
    }
    public function updatedType(){
        session()->put('type', $this->type);

    }
    public function updatedCabangId(){
        $this->emit('cabangChange', $this->cabang_id);
        session()->put('cabang_id', $this->cabang_id);
    }
    public function supplierChange($id){
        $this->supplier_id = $id;
        $this->emit('render-select2', $this->supplier_id, $this->customer_id);
        session()->put('supplier_id', $this->supplier_id);

    }
    public function customerChange($id){
        $this->customer_id = $id;
        $this->emit('render-select2', $this->supplier_id, $this->customer_id);
        session()->put('customer_id', $this->customer_id);
    }
    public function validateMetaInfo($items){
        $this->emit('openConfirmModal', ['metainfo' => $this->metainfo, 'items' => $items]);
    }
    public function render(){
        return view('livewire.gudang.retur.meta-info');
    }
}
