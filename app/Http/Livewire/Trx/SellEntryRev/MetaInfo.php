<?php

namespace App\Http\Livewire\Trx\SellEntryRev;

use App\Models\Customer;
use Livewire\Component;

class MetaInfo extends Component{
    public $customerSelect, $customer_id, $is_paid;
    public $grand_price, $grand_discount, $sub_total;
    public $metainfo;
    protected $listeners = ['grandPriceUpdate', 'validateMetaInfo', 'customerChange'];
    public function mount(){
        $this->customerSelect = Customer::all();
    }
    public function customerChange($val){
        $this->customer_id = $val;
        $this->metainfo['customer_id'] = $this->customer_id == null ? null : $this->customer_id;
    }
    public function grandPriceUpdate($val){
        $this->grand_price = $val['totalSum'];
        $this->grand_discount = $val['totalDisc'];
        $this->sub_total = $val['subTotal'];

        $this->metainfo = [
            'totalSum'      => $val['totalSum'],
            'totalDisc'     => $val['totalDisc'],
            'subTotal'      => $val['subTotal'],
            'customer_id'   => $this->customer_id == null ? null : $this->customer_id
        ];
    }
    public function validateMetaInfo($items){
        $this->emit('openConfirmModal', ['metainfo' => $this->metainfo, 'items' => $items]);
    }
    public function render(){
        return view('livewire.trx.sell-entry-rev.meta-info');
    }
}
