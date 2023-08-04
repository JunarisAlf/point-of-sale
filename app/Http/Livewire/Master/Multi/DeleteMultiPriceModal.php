<?php

namespace App\Http\Livewire\Master\Multi;

use App\Models\MultiPrice;
use Exception;
use Livewire\Component;

class DeleteMultiPriceModal extends Component{
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openDeleteModal' => 'openModal'];
    public function openModal($id){
        try {
            $multiprice = MultiPrice::find($id);
            $this->data_id = $multiprice->id;
            $this->data_name = $multiprice->quantity;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function destroy($id){
        try {
            MultiPrice::destroy($id);
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_multiprice_table');

        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render() {
        return view('livewire.master.multi.delete-multi-price-modal');
    }
}
