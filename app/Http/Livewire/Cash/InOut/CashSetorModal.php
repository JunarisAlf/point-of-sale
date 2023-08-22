<?php

namespace App\Http\Livewire\Cash\InOut;

use App\Models\Deposit;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class CashSetorModal extends Component{
    public $show = false;
    public $data_id, $data_name, $note, $cabang_id, $date;

    protected $listeners = ['openSetorModal' => 'openModal'];
    public function openModal($data){
        $this->data_name = $data['cashSum'];
        $this->cabang_id = $data['cabang_id'];
        $this->date = $data['date'];
        $this->show = true;
    }

    public function store(){
        try {
            Deposit::create([
                'cabang_id'     => $this->cabang_id ,
                'date'          => $this->date,
                'note'          => $this->note,
                'total'         => $this->data_name,
            ]);
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_cash_table');
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.cash.in-out.cash-setor-modal');
    }
}
