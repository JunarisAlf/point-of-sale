<?php

namespace App\Http\Livewire\Gudang\Retur;

use App\Models\Cabang;
use App\Models\Customer;
use Livewire\Component;

class MetaInfo extends Component{
    public $user;
    public $cabangSelect, $cabang_id, $note, $type = 'ke-supplier';
    public $metainfo;
    protected $listeners = ['validateMetaInfo'];
    public function mount(){
        $this->cabangSelect = Cabang::all();
        session()->put('type', $this->type);
    }
    public function updatedNote(){
        session()->put('note', $this->note);
    }
    public function updatedType(){
        session()->put('type', $this->type);
    }
    public function updatedCabangId(){
        $this->emit('cabangChange', $this->cabang_id);
        session()->put('cabang_id', $this->cabang_id);
    }
    public function validateMetaInfo($items){
        $this->emit('openConfirmModal', ['metainfo' => $this->metainfo, 'items' => $items]);
    }
    public function render(){
        return view('livewire.gudang.retur.meta-info');
    }
}
