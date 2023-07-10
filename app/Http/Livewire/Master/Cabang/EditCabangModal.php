<?php

namespace App\Http\Livewire\Master\Cabang;

use App\Models\Cabang;
use Exception;
use Livewire\Component;

class EditCabangModal extends Component {
    public $show = false;
    public $data_id, $name, $address;
    protected $listeners = ['openEditModal' => 'openModal'];
    public function openModal($id){
        try {
            $cabang = Cabang::find($id);
            $this->data_id = $cabang->id;
            $this->name = $cabang->name;
            $this->address = $cabang->address;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function rules(){
        return [
            'name'      => 'required|string',
            'address'   => 'required|string'
        ];
    }
    public function update($id){
        $validated = $this->validate();
        try{
            $cabang = Cabang::find($id);
            $cabang->fill($validated);
            $cabang->save();
            $this->emit('showSuccessAlert', 'Berhasil Mengedit Data!');
            $this->emit('refresh_cabang_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render() {
        return view('livewire.master.cabang.edit-cabang-modal');
    }
}
