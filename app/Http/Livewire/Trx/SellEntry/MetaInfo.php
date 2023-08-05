<?php

namespace App\Http\Livewire\Trx\SellEntry;

use Livewire\Component;

class MetaInfo extends Component{
    public $grand_price, $grand_discount;
    protected $listeners = ['grandPriceUpdate'];
    public function grandPriceUpdate($val){
        $this->grand_price = $val['totalSum'];
        $this->grand_discount = $val['totalDisc'];
    }
    public function render(){
        return view('livewire.trx.sell-entry.meta-info');
    }
}
