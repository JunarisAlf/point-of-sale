<?php

namespace App\Http\Livewire\Gudang\Opname;

use App\Models\Cabang;
use Carbon\Carbon;
use Livewire\Component;

class Date extends Component {
    public $user;
    public $opname_date;
    // cabang
    public $cabang_id ;
    public $cabangSelect;
    public function mount(){
        $this->opname_date = Carbon::now()->format('Y-m-d');
        $this->emit('dateChanged', $this->opname_date);
        $this->cabangSelect =  Cabang::all();
        $this->cabang_id = $this->user->role === 'master' ? null : $this->user->cabang->id;
    }
    public function updatedOpnameDate(){
        $this->emit('dateChanged', $this->opname_date);
    }
    public function updatedCabangId(){
        $this->emit('cabangChange', $this->cabang_id);
    }
    public function render() {
        return view('livewire.gudang.opname.date');
    }
}
