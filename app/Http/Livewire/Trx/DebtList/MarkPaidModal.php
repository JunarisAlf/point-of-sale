<?php

namespace App\Http\Livewire\Trx\DebtList;

use App\Models\Buy;
use App\Models\Cash;
use App\Models\Supplier;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MarkPaidModal extends Component{
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openMarkPaidModal' => 'openModal'];
    public function openModal($id){
        try {
            $buy = Buy::find($id);
            $this->data_id = $buy->id;
            $this->data_name = $buy->supplier->name . ": Rp." . number_format($buy->details->sum('grand_price'), 0, ',', '.');
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function markPaid($id){
        DB::beginTransaction();
        try{
            $buy = Buy::find($id);
            $buy->is_paid = true;
            $buy->paid_date = Carbon::now()->format('Y-m-d H:i:s');
            $buy->save();
            Cash::create([
                'cabang_id'     => $buy->cabang_id,
                'date'          => Carbon::now()->format('Y-m-d H:i:s'),
                'flow'          => 'out',
                'total'         => $buy->details()->sum('grand_price'),
                'name'          => "Pelunasan Ke Supplier " . @Supplier::find($buy->supplier_id)->name
            ]);
            $this->show = false;
            DB::commit();
            $this->emit('showSuccessAlert', 'Berhasil Melakukan Pelunasan!');
            $this->emit('refresh_debt_table');
        }catch(Exception $e){
            DB::rollBack();
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.trx.debt-list.mark-paid-modal');
    }
}
