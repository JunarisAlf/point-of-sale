<?php

namespace App\Http\Livewire\Cash\CashIn;

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
        $this->cashes = Cash::whereDate('date', $this->date)
            ->where('cabang_id', $this->cabang_id)
            ->where('is_stor', false)
            ->orderBy('date', 'DESC')
            ->where('flow', 'in')
            ->get();
        $this->cashSum =  $this->cashes->sum('total');
    }
    public function render(){
        return view('livewire.cash.cash-in.cash-table');
    }
}
