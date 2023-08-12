<?php

namespace App\Http\Livewire\Cash\Assets;

use App\Models\Cabang;
use App\Models\Item;
use Livewire\Component;

class AssetsTable extends Component{
    public $cabang_id = 'all', $cabangSelect, $items, $totalAssets = 0, $incomePred = 0, $profit, $percentage;
    public function mount(){
        $this->cabangSelect = Cabang::all();
        $cabangId = $this->cabang_id;
        $this->items = Item::
            with(['stocks' => function($query) use ($cabangId){
                if($cabangId !== 'all'){
                    $query->where('cabang_id', $cabangId);
                }
            }])
            ->whereHas('stocks', function($query) use ($cabangId){
                if($cabangId !== 'all'){
                    $query->where('cabang_id', $cabangId);
                }
            })
            ->withSum(['stocks as quantity_sum' => function ($query) use ($cabangId) {
                if($cabangId !== 'all'){
                    $query->where('cabang_id', $cabangId);
                }
            }], 'quantity')->get();

        $totalAssets = 0;
        $incomePred = 0;
        foreach ($this->items as $key => $item) {
            $subAsset = $item->stocks->avg('buying_price') * $item->quantity_sum;
            $totalAssets += $subAsset;

            $subIncome = $item->selling_price * $item->quantity_sum;
            $incomePred += $subIncome;
        }
        $this->totalAssets = $totalAssets;
        $this->incomePred = $incomePred;
        $this->profit = $incomePred - $totalAssets;
        $this->percentage = $this->profit * 100 / $totalAssets;

    }
    public function updatedCabangId(){
        $this->mount();
    }
    public function render(){
        return view('livewire.cash.assets.assets-table');
    }
}
