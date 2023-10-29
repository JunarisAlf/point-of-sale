<?php

namespace App\Http\Livewire\Cash\CashIn;

use App\Models\Cash;
use App\Models\Deposit;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CashSetorModal extends Component{
    public $show = false;
    public $data_id, $data_name, $note, $total, $cabang_id, $date;

    protected $listeners = ['openSetorModal' => 'openModal'];
    public function openModal($data){
        $this->cabang_id = $data['cabang_id'];
        $this->date = $data['date'];
        $this->show = true;
    }

    public function store(){
        $this->validate([
            'total'     => 'required|integer',
            'note'      => 'required|string'
        ]);
        DB::beginTransaction();
        try {
            $details = Cash::whereDate('date', $this->date)
                ->where('cabang_id', $this->cabang_id)
                ->where('is_stor', false)
                ->get();
            $total_system = $details->where('flow', 'in')->sum('total') - $details->where('flow', 'out')->sum('total');
            $datas = $details->toJson();

            $details->each(function ($item) {
                $item->is_stor = true;
            });
            $details->each->save();

            Deposit::create([
                'cabang_id'     => $this->cabang_id ,
                'date'          => $this->date,
                'note'          => $this->note,
                'total'         => intval($this->total),
                'total_system'  => $total_system,
                'user_id'       => Auth::user()->id,
                'data'          => $datas
            ]);
            $this->show = false;
            DB::commit();
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_cash_table');
        } catch (Exception $e) {
            DB::rollBack();
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.cash.cash-in.cash-setor-modal');
    }
}
