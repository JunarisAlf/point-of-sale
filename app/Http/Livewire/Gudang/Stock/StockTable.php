<?php

namespace App\Http\Livewire\Gudang\Stock;

use App\Models\Cabang;
use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class StockTable extends Component{
    public $cabang_id = 1;
    public $items;
    protected $listeners = ['refresh_item_table' => 'refresh'];
    public function mount(){
        $cabangId = $this->cabang_id;
        $this->items = Cabang::with('stocks')->find($cabangId);

        dd($this->items);
    }
    public function refresh(){
        $this->items = Item::latest()->get();
    }
    public function render(){
        return view('livewire.gudang.stock.stock-table');
    }
}
