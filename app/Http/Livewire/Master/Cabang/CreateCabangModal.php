<?php

namespace App\Http\Livewire\Master\Cabang;

use Livewire\Component;

class CreateCabangModal extends Component{
    public $show = false;
    protected $listeners = ['openCreateModal' => 'openModal'];
    public function openModal(){
        $this->show = true;
    }
    public function render(){
        return view('livewire.master.cabang.create-cabang-modal');
    }
}
