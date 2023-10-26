<?php

namespace App\Http\Livewire\Trx\BuyList;

use App\Models\Buy;
use Exception;
use Livewire\Component;

class DeleteBuyModal extends Component{
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openDeleteModal' => 'openModal'];
    public function openModal($id){
        try {
            $buy = Buy::find($id);
            $this->data_id = $buy->id;
            $this->data_name = $buy->supplier->name . " " . $buy->cabang->name . " " . $buy->note;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function destroy($id){
        try {
            Buy::destroy($id);
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_buy_table');
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.trx.buy-list.delete-buy-modal');
    }
}
