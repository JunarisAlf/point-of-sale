<?php

namespace App\Http\Livewire\Trx\BuyEntry;

use App\Models\Cabang;
use App\Models\Supplier;
use Carbon\Carbon;
use Livewire\Component;

class Entry extends Component{
    public $suppliers = [], $supplier_id;
    public $cabangs = [], $cabang_id;
    public $is_paid = 0, $is_arrived = 1;
    public $date, $grand_price = 0, $note;
    protected $listeners = ['grandPriceUpdate', 'submited', 'supplierChange'];
    public function submited(){
        $this->resetExcept('cabang', 'date');
    }
    public function grandPriceUpdate($val){
        $this->grand_price = $val;
    }
    public function supplierChange($val){
        $this->supplier_id = $val;
        $this->updated();
    }
    public function updated(){
        session()->put('buy', [
            'supplier_id'   => $this->supplier_id,
            'cabang_id'     => $this->cabang_id,
            'date'          => $this->date,
            'is_paid'       => $this->is_paid,
            'is_arrived'    => $this->is_arrived,
            'note'          => $this->note,
            'grand_price'   => $this->grand_price
        ]);
    }
    public function mount(){
        $this->suppliers = Supplier::all();
        $this->date = Carbon::now()->format('Y-m-d H:i:s');
        $this->cabangs = Cabang::all();
    }
    public function render() {
        return view('livewire.trx.buy-entry.entry');
    }
}
