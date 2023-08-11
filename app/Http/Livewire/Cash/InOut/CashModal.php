<?php

namespace App\Http\Livewire\Cash\InOut;

use App\Models\Cash;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CashModal extends Component{
    public $cash_flow, $name, $amount;
    public $cabang_id;
    public $show = false;
    protected $listeners = ['openCreateModal' => 'openModal'];
    public function openModal($cabang_id){
        $this->cabang_id = $cabang_id;
        $this->show = true;
    }
    public function store(){
        $validated = $this->validate([
            'cash_flow'     => 'required|string|in:out,in',
            'amount'        => 'required|integer|min:1',
            'name'          => 'required|string'
        ]);
        try{
            Cash::create([
                'cabang_id'     => $this->cabang_id,
                'date'          => Carbon::now()->format('Y-m-d H:i:s'),
                'flow'          => $validated['cash_flow'],
                'total'         => $validated['amount'],
                'name'          => $validated['name']
            ]);
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('refresh_cash_table');
            $this->show = false;
            $this->reset();
            $this->dispatchBrowserEvent('amount-updated');
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.cash.in-out.cash-modal');
    }
}
