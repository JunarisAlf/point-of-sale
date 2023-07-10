<?php

namespace App\Http\Livewire\Master\Cabang;

use App\Models\Cabang;
use Exception;
use Livewire\Component;

class DeleteCabangModal extends Component {
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openDeleteModal' => 'openModal'];
    public function openModal($id){
        try {
            $cabang = Cabang::find($id);
            $this->data_id = $cabang->id;
            $this->data_name = $cabang->name;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function destroy($id){
        try {
            Cabang::destroy($id);
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_cabang_table');

        } catch (Exception $e) {
            dd($e);
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render() {
        return view('livewire.master.cabang.delete-cabang-modal');
    }
}
