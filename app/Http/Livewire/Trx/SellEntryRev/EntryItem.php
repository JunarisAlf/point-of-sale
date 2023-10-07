<?php

namespace App\Http\Livewire\Trx\SellEntryRev;

use App\Models\Item;
use App\Models\QtyConverter;
use App\Models\StockItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EntryItem extends Component{
    public $items;
    public $quantity, $maxQuantity,$item_id, $price, $total_price, $discount = 0, $percentage = 0;
    public  $qtyAliases = [], $qtyAlias_id, $converted_qty;
    protected $listeners = ['itemChanged'];
    public function itemChanged($item_id){
        if($item_id !== null){
            $this->item_id = $item_id;
            $this->quantity = 1;
            $qtyAlias = QtyConverter::where('item_id', $item_id)->orderBy('quantity', 'ASC')->first();
            $this->qtyAlias_id = $qtyAlias?->id;
            $this->converted_qty = $qtyAlias->quantity * $this->quantity;
            $this->price = Item::find($item_id)->selling_price;
            $this->total_price = $this->price * $this->quantity;
            $cabang_id = Auth::user()->cabang?->id == null ? 1 : Auth::user()->cabang->id;
            $this->maxQuantity = StockItem::where('item_id', $item_id)->where('cabang_id', $cabang_id)->where('quantity', '>', 0)->sum('quantity');
            $this->submit();
        }

    }


    public function mount(){
        $this->items = Item::all();
    }

    public function submit(){
        $this->validate([
            'item_id'       => 'required|exists:items,id'
        ]);
        $item = [
            'id'            => $this->item_id,
            'quantity'      => $this->quantity,
            'satuan_id'     => $this->qtyAlias_id,
            'converted_qty' => $this->converted_qty,
            'discount'      => $this->discount,
            'price'         => $this->price,
            'total_price'   => $this->total_price,
        ];
        $this->emit('itemSubmit', $item);
        $this->dispatchBrowserEvent('itemSubmited');
        $this->resetExcept('items');
    }
    public function render(){
        return view('livewire.trx.sell-entry-rev.entry-item');
    }
}
