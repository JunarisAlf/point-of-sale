<?php

namespace App\Http\Livewire\Trx\SellEntry;

use App\Models\Item;
use App\Models\QtyConverter;
use App\Models\StockItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EntryItem extends Component{
    public $items;
    public $quantity, $maxQuantity,$item_id, $price, $total_price, $discount = 0, $percentage = 0;
    public  $qtyAliases = [], $qtyAlias_id, $converted_qty;
    protected $listeners = ['itemChanged', 'discountChange'];
    public function itemChanged($item_id){
        $this->item_id = $item_id;
        $this->discount = 0;
        $cabang_id = Auth::user()->cabang?->id == null ? 1 : Auth::user()->cabang->id;
        $this->maxQuantity = StockItem::where('item_id', $item_id)->where('cabang_id', $cabang_id)->where('quantity', '>', 0)->sum('quantity');
        $this->qtyAliases = QtyConverter::where('item_id', $item_id)->orderBy('quantity', 'ASC')->get();
        $this->qtyAlias_id = $this->qtyAliases?->first()?->id;
        $this->dispatchBrowserEvent('discount-updated');
        $this->updatedQuantity();
    }

    public function updatedPercentage(){
        $this->percentage = $this->percentage == null ? 0 : floatval($this->percentage);

        //get original total price
        if($this->item_id !== null && $this->quantity !== null){
            $item = Item::find($this->item_id);
            $multiprice = $item->prices()->where('quantity', '<=', $this->converted_qty)->orderByDesc('quantity')->first();
            $this->price = $multiprice == null ? $item->selling_price : $multiprice->price;
            $this->total_price = $this->price * $this->converted_qty;
        }

        $this->discount = $this->total_price * $this->percentage / 100;
        $this->total_price = $this->total_price -  $this->discount;
        $this->dispatchBrowserEvent('total_price-updated');
        $this->dispatchBrowserEvent('discount-updated');
    }
    public function discountChange($disc){
        $disc = $disc === '' ? 0 : intval($disc);

        //get original total price
        if($this->item_id !== null && $this->quantity !== null){
            $item = Item::find($this->item_id);
            $multiprice = $item->prices()->where('quantity', '<=', $this->converted_qty)->orderByDesc('quantity')->first();
            $this->price = $multiprice == null ? $item->selling_price : $multiprice->price;
            $this->total_price = $this->price * $this->converted_qty;
        }

        $this->discount = $disc;
        $this->percentage = $this->discount * 100 / $this->total_price;
        $this->percentage = number_format($this->percentage, 2, '.', ',');
        $this->total_price = $this->total_price - $this->discount;
        $this->dispatchBrowserEvent('total_price-updated');
    }
    public function updatedQuantity(){
        if($this->item_id !== null && $this->quantity !== null){
            // convert the qty
            $satuan_qty = QtyConverter::find($this->qtyAlias_id)->quantity;
            $this->converted_qty = $this->quantity * $satuan_qty;

            $item = Item::find($this->item_id);
            $multiprice = $item->prices()->where('quantity', '<=', $this->converted_qty)->orderByDesc('quantity')->first();
            $this->price = $multiprice == null ? $item->selling_price : $multiprice->price;
            $this->dispatchBrowserEvent('price-updated');
            $this->total_price = ($this->price * $this->converted_qty) - $this->discount;
            $this->dispatchBrowserEvent('total_price-updated');
        }
    }
    public function updatedQtyAliasId(){
        $this->updatedQuantity();
    }
    public function mount(){
        $this->items = Item::all();
    }

    public function submit(){
        $this->validate([
            'quantity'      => 'required|integer|min:1|max:' . $this->maxQuantity,
            'item_id'       => 'required|exists:items,id'
        ]);
        $item = [
            'id'            => $this->item_id,
            'quantity'      => $this->quantity,
            'converted_qty' => $this->converted_qty,
            'satuan_id'     => $this->qtyAlias_id,
            'discount'      => $this->discount,
            'percentage'    => $this->percentage,
            'price'         => $this->price,
            'total_price'   => $this->total_price,
        ];
        $this->emit('itemSubmit', $item);
        $this->dispatchBrowserEvent('itemSubmited');
        $this->resetExcept('items');
    }
    public function render(){
        return view('livewire.trx.sell-entry.entry-item');
    }
}
