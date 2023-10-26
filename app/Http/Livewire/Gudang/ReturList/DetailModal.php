<?php

namespace App\Http\Livewire\Gudang\ReturList;

use App\Models\Retur;
use Livewire\Component;

class DetailModal extends Component{
    public $show = false;
    public $details = [];
    protected $listeners = ['openDetailModal' => 'openModal'];
    public function openModal($id){
        $this->details = Retur::with('details')->find($id);
        $this->details = $this->details->details;
        $this->show = true;
    }
    public function render(){
        return view('livewire.gudang.retur-list.detail-modal');
    }
}
