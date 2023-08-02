<?php

namespace App\Http\Livewire\Gudang\Transfer;

use App\Models\Cabang;
use App\Models\Item;
use App\Models\StockItem;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TransferItemModal extends Component{
    public $show = false;
    protected $listeners = ['openTransferModal' => 'openModal', 'cabangChanged'];
    public $stock_id, $cabang_id, $quantity, $stock_quantity, $cabangSelect;
    public function mount(){
        $this->cabangSelect = Cabang::all();
    }
   
    public function openModal($id){
        $this->stock_id = $id;  
        $stock = StockItem::find($id);
        $this->stock_quantity = $stock->quantity;
        $this->show = true;
    }
    public function rules(){
        return [
            'quantity'      => 'required|integer|min:1|max:' . $this->stock_quantity,
            'cabang_id'     => ['required', 'exists:cabangs,id'],
        ];
    }
    public function store(){
        $validated = $this->validate();
        DB::beginTransaction();
        try{
            
            $old_stock = StockItem::find($this->stock_id);
            $old_stock->quantity -= $validated['quantity'];
            // TODO: update trx
            $old_stock->save();
            
            // target cabang
            $item_id = $old_stock->item->id;
            $expired_date = $old_stock->expired_date; //expired date item on old gudang
            $price = $old_stock->buying_price; //price date item on old gudang

            $item_transfered = Item::find($item_id);
            $stock_target = $item_transfered->stocks()->where('cabang_id', $this->cabang_id);

            $oldQtySum = $stock_target->sum('quantity');
            $oldPrice = $stock_target->avg('buying_price') ?? 0;
            $oldModalSum = $oldQtySum * $oldPrice;
            $addedModalSum = $price * $validated['quantity'];
            $newPrice = ($oldModalSum + $addedModalSum) / ($oldQtySum + $validated['quantity']);
            $str = "$oldModalSum + $addedModalSum / $oldQtySum + " . $validated['quantity'];
            // dd($newPrice);
            $has_expired = $item_transfered->has_expired;
            if($has_expired){
                $stock = $stock_target->where('expired_date', $expired_date)->first();
                if($stock == null || $stock_target == null){
                    // no stock with same exp date OR actually no stock
                    $stock_target->create([
                        'cabang_id'     => $this->cabang_id,
                        'expired_date' => $expired_date,
                        'buying_price' => $newPrice,
                        'quantity' => $validated['quantity']
                    ]);
                }else{
                    //else update exists
                    $stock->quantity += $validated['quantity'];
                    $stock->buying_price = $newPrice;
                    $stock->save();
                }
                //update price for same item with different expired date
                StockItem::where('cabang_id', $this->cabang_id)->where('item_id', $item_id)->update(['buying_price' => $newPrice]);

            }else{
                //update qty for item with no exp date
                $stock = $stock_target->where('expired_date', null)->first();
                $stock->quantity += $validated['quantity'];
                $stock->save();
            }
            DB::commit();   

            $this->emit('showSuccessAlert', 'Berhasil Transfer Stock!');
            $this->emit('refresh_item_table');
            $this->show = false;
            
        }catch(Exception $e){
            DB::rollback();
            dd($e);
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->resetExcept('cabangSelect');
    }
    public function render(){
        return view('livewire.gudang.transfer.transfer-item-modal');
    }
}
