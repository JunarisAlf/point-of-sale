<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Buy;
use App\Models\CustomerTrx;
use App\Models\StockItem;
use Livewire\Component;

class MoneyCount extends Component{
    public $assetSum, $debtSum, $piutangSum;
    public function mount(){
        // assets
        $stocks = StockItem::where('quantity', '>', 0)->get();
        foreach ($stocks as $key => $stock) {
            $this->assetSum += $stock->quantity * $stock->buying_price;
        }

        // hutang / debt
        $buys = Buy::where('is_paid', false)->withSum('details as price_sum', 'grand_price')->get();
        foreach ($buys as $key => $buy) {
            $this->debtSum += $buy->price_sum;
        }

        $this->piutangSum = CustomerTrx::where('is_paid', false)->sum('total');
    }
    public function render(){
        return view('livewire.dashboard.money-count');
    }
}
