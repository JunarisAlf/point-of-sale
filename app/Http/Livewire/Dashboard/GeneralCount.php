<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Cabang;
use App\Models\Customer;
use App\Models\CustomerTrx;
use App\Models\Item;
use Livewire\Component;

class GeneralCount extends Component{
    public $storeCount, $itemCount, $customerCount, $trxCount;
    public function mount(){
        $this->storeCount = Cabang::count();
        $this->itemCount = Item::count();
        $this->customerCount = Customer::count();
        $this->trxCount = CustomerTrx::count();
    }
    public function render(){
        return view('livewire.dashboard.general-count');
    }
}
