<?php

namespace App\Http\Livewire\Gudang\Opname;

use Carbon\Carbon;
use Livewire\Component;

class Date extends Component {
    public $opname_date;
    public function mount(){
        $this->opname_date = Carbon::now()->format('Y-m-d');
        $this->emit('dateChanged', $this->opname_date);
    }
    public function updatedOpnameDate(){
        $this->emit('dateChanged', $this->opname_date);
    }
    public function render() {
        return view('livewire.gudang.opname.date');
    }
}
