<?php

namespace App\Http\Livewire\Master\Multi;

use App\Models\QtyConverter;
use Exception;
use Livewire\Component;

class CreateQtyConvModal extends Component{
    public $show = false;
    public $item_id, $quantity, $name;
    protected $listeners = ['openQtyConv' => 'openModal'];
    public function openModal($id){
        $this->item_id = $id;
        $this->show = true;
    }
    public function store(){
        $this->validate(['name' => 'required', 'quantity' => 'required']);
        try{
            QtyConverter::create([
                'item_id'       => $this->item_id,
                'name'          => $this->name,
                'quantity'      => $this->quantity
            ]);
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('refresh_multiprice_table');
            $this->show = false;
        }catch(Exception $e){
            dd($e);
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render(){
        return view('livewire.master.multi.create-qty-conv-modal');
    }
}
