<?php

namespace App\Http\Livewire\Master\Multi;

use App\Models\QtyConverter;
use Exception;
use Livewire\Component;

class EditQtyConvModal extends Component{
    public $show = false;
    public $data_id, $quantity, $name;
    protected $listeners = ['openEditQtyConvModal' => 'openModal'];
    public function openModal($id){
        $conv = QtyConverter::find($id);
        $this->data_id = $conv->id;
        $this->fill($conv);
        $this->show = true;
    }
    public function update(){
        $validated = $this->validate(['name' => 'required', 'quantity' => 'required']);
        try{
            $conv = QtyConverter::find($this->data_id);
            $conv->fill($validated);
            $conv->save();
            $this->emit('showSuccessAlert', 'Berhasil Mengupdate Data!');
            $this->emit('refresh_multiprice_table');
            $this->show = false;
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render(){
        return view('livewire.master.multi.edit-qty-conv-modal');
    }
}
