<?php

namespace App\Http\Livewire\Gudang\TransferList;

use App\Models\StockItem;
use App\Models\TransferStock;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RejectModal extends Component {
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openRejectModal' => 'openModal'];
    public function openModal($id){
        try {
            $transfer = TransferStock::find($id);
            $this->data_id = $transfer->id;
            $this->data_name = $transfer->item->name . ": " . $transfer->quantity;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function confirm($id){
        DB::beginTransaction();
        try{
            $transfer = TransferStock::find($this->data_id);
            $stock = StockItem::find($transfer->stock_id);
            $stock->quantity += $transfer->quantity;
            $stock->save();
            $transfer->is_reject = true;
            $transfer->save();
            DB::commit();
            $this->emit('showSuccessAlert', 'Berhasil Menolak Barang!');
            $this->emit('refresh_item_table');
            $this->show = false;

        }catch(Exception $e){
            DB::rollback();
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render() {
        return view('livewire.gudang.transfer-list.reject-modal');
    }
}
