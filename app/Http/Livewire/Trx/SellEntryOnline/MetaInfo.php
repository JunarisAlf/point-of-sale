<?php

namespace App\Http\Livewire\Trx\SellEntryOnline;

use App\Models\Cabang;
use App\Models\Customer;
use Livewire\Component;

class MetaInfo extends Component{
    public $cabangSelect, $cabang_id, $note, $is_paid;
    public $grand_price, $grand_discount, $sub_total;
    public $metainfo;
    protected $listeners = ['grandPriceUpdate', 'validateMetaInfo', 'customerChange'];
    public function mount(){
        $this->cabangSelect = Cabang::all();
    }
    public function updatedNote(){
        session()->put('note', $this->note);
    }
    public function updatedCabangId(){
        $this->emit('cabangChange', $this->cabang_id);
        session()->put('cabang_id', $this->cabang_id);
    }
    public function grandPriceUpdate($val){
        $this->grand_price = $val['totalSum'];

        $this->metainfo = [
            'totalSum'      => $val['totalSum'],
        ];
    }
    public function validateMetaInfo($items){
        $this->emit('openConfirmModal', ['metainfo' => $this->metainfo, 'items' => $items]);
    }
    public function render(){
        return view('livewire.trx.sell-entry-online.meta-info');
    }
}
