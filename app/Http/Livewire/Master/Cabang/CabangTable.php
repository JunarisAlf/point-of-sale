<?php

namespace App\Http\Livewire\Master\Cabang;

use App\Models\Cabang;
use Livewire\Component;

class CabangTable extends Component{
    public $cabangs;
    protected $listeners = ['refresh_cabang_table' => 'refresh'];
    public function mount(){
        $this->cabangs = Cabang::latest()->get();
    }
    public function refresh(){
        $this->cabangs = Cabang::latest()->get();
    }
    public function render(){
        return view('livewire.master.cabang.cabang-table');
    }
}
