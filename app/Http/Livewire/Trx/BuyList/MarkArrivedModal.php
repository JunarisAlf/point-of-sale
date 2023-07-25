<?php

namespace App\Http\Livewire\Trx\BuyList;

use App\Models\Buy;
use Exception;
use Livewire\Component;

class MarkArrivedModal extends Component{
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openMarkArrivedModal' => 'openModal'];
    public function openModal($id){
        try {
            $buy = Buy::find($id);
            $this->data_id = $buy->id;
            $this->data_name = $buy->supplier->name ;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function markArrived($id){
        try{
            $buy = Buy::find($id);
            $buy->is_arrived = true;
            $buy->save();
            $this->show = false;
            $this->emit('showSuccessAlert', 'Barang telah sampai!');
            $this->emit('refresh_buy_table');
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.trx.buy-list.mark-arrived-modal');
    }
}
