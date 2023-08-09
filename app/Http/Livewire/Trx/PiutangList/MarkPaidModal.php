<?php

namespace App\Http\Livewire\Trx\PiutangList;

use App\Models\CustomerTrx;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class MarkPaidModal extends Component{
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openMarkPaidModal' => 'openModal'];
    public function openModal($id){
        try {
            $trx = CustomerTrx::find($id);
            $this->data_id = $trx->id;
            $this->data_name = $trx->customer->name . ": Rp." . number_format($trx->total);
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function markPaid($id){
        try{
            $trx = CustomerTrx::find($id);
            $trx->is_paid = true;
            $trx->paid_date = Carbon::now()->format('Y-m-d H:i:s');
            $trx->save();
            $this->show = false;
            $this->emit('showSuccessAlert', 'Berhasil Melakukan Pelunasan!');
            $this->emit('refresh_piutang_table');
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.trx.piutang-list.mark-paid-modal');
    }
}
