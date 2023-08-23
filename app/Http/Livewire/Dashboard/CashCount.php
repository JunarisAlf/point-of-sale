<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Buy;
use App\Models\CustomerTrx;
use App\Models\OnlineTrx;
use Carbon\Carbon;
use DivisionByZeroError;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CashCount extends Component{
    public $sellSum, $percentage, $sellDateStart, $sellDateEnd;
    public $cashOutSum, $cashOutPercentage, $cashOutDateStart, $cashOutDateEnd;

    protected $listeners = ['sellDateRangeChange', 'cashOutRangeChange'];

    public function mount(){
        $this->sellDateStart = Carbon::now()->format('Y-m-d');
        $this->sellDateEnd = Carbon::now()->format('Y-m-d');
        $this->sellSum = CustomerTrx::whereBetween('date', [$this->sellDateStart, $this->sellDateEnd])->sum('total');

        $this->cashOutDateStart = Carbon::now()->format('Y-m-d');
        $this->cashOutDateEnd = Carbon::now()->format('Y-m-d');
        $buys = Buy::whereBetween(DB::raw('DATE(buys.created_at)'), [$this->cashOutDateStart, $this->cashOutDateEnd])->get();
        $this->cashOutSum = 0;
        foreach ($buys as $key => $buy) {
            $this->cashOutSum += $buy->details()->sum('grand_price');
        }
    }
    public function sellDateRangeChange($start, $end){
        $this->sellSum = CustomerTrx::whereBetween(DB::raw('DATE(date)'), [$start, $end])->sum('total') + OnlineTrx::whereBetween(DB::raw('DATE(date)'), [$start, $end])->sum('total');

        $endNew = Carbon::parse($start)->subDays(1)->format('Y-m-d');
        $daysDif = Carbon::parse($start)->diffInDays(Carbon::parse($end));
        $startNew = Carbon::parse($endNew)->subDays($daysDif)->format('Y-m-d');

        $sellSumPrev = CustomerTrx::whereBetween(DB::raw('DATE(date)'), [$startNew, $endNew])->sum('total') + OnlineTrx::whereBetween(DB::raw('DATE(date)'), [$startNew, $endNew])->sum('total');
        try{
            $this->percentage =round(($this->sellSum * 100 / $sellSumPrev) - 100, 2);
        }catch(DivisionByZeroError $e){
            $this->percentage  = "NaN";
        }
    }
    public function cashOutRangeChange($start, $end){

        $buys = Buy::whereBetween(DB::raw('DATE(buys.created_at)'), [$start, $end])->get();
        $this->cashOutSum = 0;
        foreach ($buys as $key => $buy) {
            $this->cashOutSum += $buy->details()->sum('grand_price');
        }
        $endNew = Carbon::parse($start)->subDays(1)->format('Y-m-d');
        $daysDif = Carbon::parse($start)->diffInDays(Carbon::parse($end));
        $startNew = Carbon::parse($endNew)->subDays($daysDif)->format('Y-m-d');

        $buys = Buy::whereBetween(DB::raw('DATE(buys.created_at)'), [$startNew, $endNew])->get();
        $cashOutSumPrev = 0;
        foreach ($buys as $key => $buy) {
            $cashOutSumPrev += $buy->details()->sum('grand_price');
        }
        try{
            $this->cashOutPercentage =round(($this->cashOutSum * 100 / $cashOutSumPrev) - 100, 2);
        }catch(DivisionByZeroError $e){
            $this->cashOutPercentage  = "NaN";
        }
    }

    public function render(){
        return view('livewire.dashboard.cash-count');
    }
}
