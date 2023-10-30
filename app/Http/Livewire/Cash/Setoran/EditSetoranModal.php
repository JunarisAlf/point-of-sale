<?php

namespace App\Http\Livewire\Cash\Setoran;

use App\Models\Cash;
use App\Models\Deposit;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditSetoranModal extends Component{
    public $show = false;
    public $data_id, $data_name, $total;

    protected $listeners = ['openEditModal' => 'openModal'];
    public function openModal($id){
        $this->data_id = $id;
        $this->show = true;
    }

    public function store(){
        $this->validate([
            'total'     => 'required|integer',
        ]);
        DB::beginTransaction();
        try {
            $setoran = Deposit::find($this->data_id);
            $setoran->total = $this->total;
            $setoran->save();
            $this->show = false;
            DB::commit();
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_setoran_table');
        } catch (Exception $e) {
            DB::rollBack();
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.cash.setoran.edit-setoran-modal');
    }
}
