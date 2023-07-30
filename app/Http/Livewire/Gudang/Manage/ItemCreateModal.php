<?php

namespace App\Http\Livewire\Gudang\Manage;

use App\Models\Item;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ItemCreateModal extends Component{
    public $show = false;
    protected $listeners = ['openCreateModal' => 'openModal', 'cabangChanged', 'itemChange'];
    public $item_id, $expired_date, $quantity, $buying_price;
    public $cabang_id = 1;
    public function cabangChanged($id){
        $this->show = false;
        $this->cabang_id = $id;
    }
    public function itemChange($id){
        $this->item_id = $id;
    }
    public $itemSelect = [];
    public function mount(){
        $this->itemSelect = Item::where('has_expired', true)->get();
    }
    public function openModal(){
        $this->show = true;
    }
    public function rules(){
        return [
            'quantity'      => 'required|integer|min:1',
            'expired_date'  => 'required'
        ];
    }
    public function store(){
        $validated = $this->validate();
        try{
            $item = Item::find($this->item_id);
            $buying_price = $item->stocks()->where('cabang_id', $this->cabang_id)->avg('buying_price');
            $validated['buying_price'] = $buying_price;
            $item->barang()->attach($this->cabang_id , $validated);
            $this->emit('showSuccessAlert', 'Berhasil Mengisi Stock Data!');
            $this->emit('refresh_item_table');
            $this->dispatchBrowserEvent('expired-created');
            $this->show = false;

        }catch(Exception $e){
            dd($e);
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render() {
        return view('livewire.gudang.manage.item-create-modal');
    }
}
