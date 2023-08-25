<?php

namespace App\Http\Livewire\Master\Multi;

use App\Models\QtyConverter;
use Exception;
use Livewire\Component;

class DeleteQtyConvModal extends Component{
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openDeleteQtyConvModal' => 'openModal'];
    public function openModal($id){
        try {
            $conv = QtyConverter::find($id);
            $this->data_id = $conv->id;
            $this->data_name = $conv->name;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function destroy($id){
        try {
            QtyConverter::destroy($id);
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_multiprice_table');

        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.master.multi.delete-qty-conv-modal');
    }
}
