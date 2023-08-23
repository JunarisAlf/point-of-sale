<?php

namespace App\Http\Livewire\Cash\InOut;

use App\Models\Buy;
use App\Models\Cabang;
use App\Models\Cash;
use App\Models\CustomerTrx;
use App\Models\Deposit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CashTable extends Component{
    public $user;
    public $cabang_id, $cabangSelect;
    public $date, $is_stored;
    public $sell, $piutang, $buy, $hutang, $cashes, $cashSum;
    protected $listeners = ['refresh_cash_table' => 'mount'];
    public function mount(){
        $this->date = Carbon::now()->format('Y-m-d');
        $this->cabangSelect = Cabang::all();
        $this->cabang_id = Auth::user()->role === 'master'  ? $this->cabangSelect->first()->id : Auth::user()->cabang->id ;
        $this->updated();
    }

    public function openSetorModal(){
        $this->emit('openSetorModal', [
            'cashSum'   => $this->cashSum,
            'cabang_id' => $this->cabang_id,
            'date'      => $this->date
        ]);
    }
    public function updated(){
        $this->sell = CustomerTrx::whereDate('date', $this->date)->where('cabang_id', $this->cabang_id)->where('is_paid', true)->where('paid_date', null)->sum('total');

        // $this->piutang = CustomerTrx::whereDate('date', $this->date)->where('cabang_id', $this->cabang_id)->where('is_paid', true)->where('paid_date', '!=', null)->sum('total');

        // $this->buy = Buy::where('cabang_id', $this->cabang_id)->whereDate('paid_date', null)->whereDate(DB::raw('DATE(created_at)'), $this->date)->where('is_paid', true)->withSum('details as total_sum', 'grand_price')->get();

        // $this->hutang = Buy::where('cabang_id', $this->cabang_id)->whereDate(DB::raw('DATE(paid_date)'), $this->date)->where('is_paid', true)->withSum('details as total_sum', 'grand_price')->get();

        // dd($this->buy, $this->hutang);
        $this->cashes = Cash::whereDate('date', $this->date)->where('cabang_id', $this->cabang_id)->orderBy('date', 'DESC')->get();
        $this->cashSum = $this->sell + $this->piutang + $this->cashes->where('flow', 'in')->sum('total') - $this->cashes->where('flow', 'out')->sum('total');
        $this->is_stored = Deposit::whereDate('date', $this->date)->exists();
    }
    public function render(){
        return view('livewire.cash.in-out.cash-table');
    }
}
