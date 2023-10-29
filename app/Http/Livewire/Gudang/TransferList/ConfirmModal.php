<?php

namespace App\Http\Livewire\Gudang\TransferList;

use App\Models\StockItem;
use App\Models\TransferStock;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ConfirmModal extends Component {
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openAccModal' => 'openModal'];
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

            // target cabang
            $item_id = $transfer->item_id;
            $expired_date = $transfer->stock->expired_date; //expired date item on old gudang
            $price = $transfer->stock->buying_price; //price date item on old gudang

            $item_transfered = $transfer->item;
            $stock_target = $item_transfered->stocks()->where('cabang_id', $transfer->to_cabang_id);

            $oldQtySum = $stock_target->sum('quantity');
            $oldPrice = $stock_target->avg('buying_price') ?? 0;
            $oldModalSum = $oldQtySum * $oldPrice;
            $addedModalSum = $price * $transfer->quantity;
            $newPrice = safeDivision($oldModalSum + $addedModalSum, $oldQtySum + $transfer->quantity);
            // $str = "$oldModalSum + $addedModalSum / $oldQtySum + " . $transfer->quantity;
            // dd($newPrice);
            $has_expired = $item_transfered->has_expired;
            if($has_expired){
                $stock = $stock_target->where('expired_date', $expired_date)->first();
                if($stock == null || $stock_target == null){
                    // no stock with same exp date OR actually no stock
                    $stock_target->create([
                        'cabang_id'     => $transfer->to_cabang_id,
                        'expired_date' => $expired_date,
                        'buying_price' => $newPrice,
                        'quantity' => $transfer->quantity
                    ]);
                }else{
                    //else update exists
                    $stock->quantity += $transfer->quantity;
                    $stock->buying_price = $newPrice;
                    $stock->save();
                }
                //update price for same item with different expired date
                StockItem::where('cabang_id', $transfer->to_cabang_id)->where('item_id', $item_id)->update(['buying_price' => $newPrice]);
            }else{
                //update qty for item with no exp date
                $stock = $stock_target->where('expired_date', null)->first();
                $stock->quantity += $transfer->quantity;
                $stock->save();
            }

            $transfer->is_acc = true;
            $transfer->save();
            DB::commit();

            $this->emit('showSuccessAlert', 'Berhasil Menerima Barang!');
            $this->emit('refresh_item_table');
            $this->show = false;

        }catch(Exception $e){
            DB::rollback();
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render() {
        return view('livewire.gudang.transfer-list.confirm-modal');
    }
}
