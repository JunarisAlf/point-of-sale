<?php

namespace App\Http\Livewire\Trx\BuyList;

use App\Models\Buy;
use Exception;
use Livewire\Component;

class MarkPaidModal extends Component{
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openMarkPaidModal' => 'openModal'];
    public function openModal($id){
        try {
            $buy = Buy::find($id);
            $this->data_id = $buy->id;
            $this->data_name = $buy->supplier->name . ": Rp." . number_format($buy->details->sum('grand_price'), 0, ',', '.');
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function markPaid($id){
        try{
            $buy = Buy::find($id);
            $buy->is_paid = true;
            $buy->save();
            $this->show = false;
            $this->emit('showSuccessAlert', 'Berhasil Melakukan Pelunasan!');
            $this->emit('refresh_buy_table');
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.trx.buy-list.mark-paid-modal');
    }
}
