<?php

namespace App\Http\Livewire\Gudang\Manage;

use App\Models\Item;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ItemFillModal extends Component {
    public $show = false;
    protected $listeners = ['openFillModal' => 'openModal', 'cabangChanged'];
    public $item_id, $has_expired, $expired_date, $quantity, $buying_price;
    public $cabang_id = 1;
    public function cabangChanged($id){
        $this->show = false;
        $this->cabang_id = $id;

    }
    public function openModal($id){
        $this->item_id = $id;
        $item = Item::find($id);
        $this->has_expired = $item->has_expired;
        $this->show = true;
    }
    public function rules(){
        return [
            'quantity'      => 'required|integer|min:1',
            'buying_price'  => 'required|integer|min:1',
            'expired_date'  =>  [Rule::requiredIf($this->has_expired)]
        ];
    }
    public function store(){
        $validated = $this->validate();

        try{
            $item = Item::find($this->item_id);
            $item->barang()->attach($this->cabang_id ,$validated);
            $this->emit('showSuccessAlert', 'Berhasil Mengisi Stock Data!');
            $this->emit('refresh_item_table');
            $this->show = false;

        }catch(Exception $e){
            dd($e);
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        // $this->resetExcept('cabang_id');
    }
    public function render() {
        return view('livewire.gudang.manage.item-fill-modal');
    }
}
