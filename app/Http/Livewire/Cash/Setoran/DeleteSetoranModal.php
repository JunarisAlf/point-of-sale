<?php

namespace App\Http\Livewire\Cash\Setoran;

use App\Models\Deposit;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class DeleteSetoranModal extends Component {
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openDeleteModal' => 'openModal'];
    public function openModal($id){
        try {
            $setoran = Deposit::find($id);
            $this->data_id = $setoran->id;
            $this->data_name ="Setoran Cabang " . $setoran->cabang->name . " Tanggal " . Carbon::parse($setoran->created_at)->format('d-m-Y H:i') . " Sebesar Rp. " . number_format($setoran->total);
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function destroy($id){
        try {
            Deposit::destroy($id);
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_setoran_table');

        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render() {
        return view('livewire.cash.setoran.delete-setoran-modal');
    }
}
