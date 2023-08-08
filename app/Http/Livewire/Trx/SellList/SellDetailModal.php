<?php

namespace App\Http\Livewire\Trx\SellList;

use App\Models\CustomerTrx;
use Livewire\Component;

class SellDetailModal extends Component{
    public $show = false;
    public $details = [];
    protected $listeners = ['openDetailModal' => 'openModal'];
    public function openModal($id){
        $trx = CustomerTrx::with('details')->find($id);
        $this->details = $trx->details;
        $this->show = true;
    }
    public function render(){
        return view('livewire.trx.sell-list.sell-detail-modal');
    }
}
