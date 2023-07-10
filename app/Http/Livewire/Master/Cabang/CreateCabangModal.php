<?php

namespace App\Http\Livewire\Master\Cabang;

use App\Models\Cabang;
use Exception;
use Livewire\Component;

class CreateCabangModal extends Component{
    public $show = false;
    public $name, $address;
    protected $listeners = ['openCreateModal' => 'openModal'];
    public function openModal(){
        $this->show = true;
    }

    public function rules(){
        return [
            'name'      => 'required|string',
            'address'   => 'required|string'
        ];
    }

    public function store(){
        $validated = $this->validate();
        try{
            Cabang::create($validated);
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('refresh_cabang_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render(){
        return view('livewire.master.cabang.create-cabang-modal');
    }
}
