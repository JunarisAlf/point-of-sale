<?php

namespace App\Http\Livewire\Gudang\Manage;

use App\Models\Item;
use App\Models\StockItem;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ItemEditModal extends Component {
    public $show = false;
    public $data_id, $has_expired, $expired_date, $quantity, $buying_price;
    protected $listeners = ['openEditModal' => 'openModal'];
    public function openModal($id){
        try {
            $stockItem = StockItem::find($id);
            $this->data_id = $stockItem->id;
            $this->has_expired = $stockItem->item->has_expired;
            $this->fill($stockItem);
            $this->buying_price = $stockItem->buying_price;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function rules(){
        return [
            'quantity'      => 'required|integer|min:1',
            'buying_price'  => 'required|integer|min:1',
            'expired_date'  =>  [Rule::requiredIf($this->has_expired)]
        ];
    }
    public function update($id){
        $validated = $this->validate();
        try{
            $stockItem = StockItem::find($id);
            $item_id = $stockItem->item_id;
            $cabang_id = $stockItem->cabang_id;
            $stockItem->fill($validated);
            $stockItem->save();
            StockItem::where('item_id', $item_id)->where('cabang_id', $cabang_id)->update(['buying_price' => $validated['buying_price']]);
            $this->emit('showSuccessAlert', 'Berhasil Mengedit Data!');
            $this->emit('refresh_item_table');
            $this->reset();
            $this->show = false;

        }catch(Exception $e){
            dd($e);
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render() {
        return view('livewire.gudang.manage.item-edit-modal');
    }
}
