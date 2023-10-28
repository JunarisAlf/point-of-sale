<?php

namespace App\Http\Livewire\Trx\SellList;

use App\Models\CustomerTrx;
use Exception;
use Livewire\Component;

class DeleteSellModal extends Component{
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openDeleteModal' => 'openModal'];
    public function openModal($id){
        try {
            $sell = CustomerTrx::find($id);
            $this->data_id = $sell->id;
            $this->data_name = "Total Transaksi: Rp. " . number_format($sell->total_pay) ;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function destroy($id){
        try {
            CustomerTrx::destroy($id);
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_sell_table');
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.trx.sell-list.delete-sell-modal');
    }
}
