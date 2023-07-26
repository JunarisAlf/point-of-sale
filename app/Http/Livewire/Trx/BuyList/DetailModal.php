<?php

namespace App\Http\Livewire\Trx\BuyList;

use App\Models\Buy;
use Livewire\Component;

class DetailModal extends Component{
    public $show = false;
    public $details = [];
    protected $listeners = ['openDetailModal' => 'openModal'];
    public function openModal($id){
        $this->details = Buy::with('details')->find($id);
        $this->details = $this->details->details;
        $this->show = true;
    }
    public function render(){
        return view('livewire.trx.buy-list.detail-modal');
    }
}
