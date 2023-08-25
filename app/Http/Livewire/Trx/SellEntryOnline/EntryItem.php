<?php

namespace App\Http\Livewire\Trx\SellEntryOnline;

use App\Models\Item;
use App\Models\QtyConverter;
use App\Models\StockItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EntryItem extends Component{
    public $items;
    public $quantity, $maxQuantity, $item_id, $cabang_id ,$price, $total_price, $discount = 0, $percentage = 0;
    public  $qtyAliases = [], $qtyAlias_id, $converted_qty;

    protected $listeners = ['itemChanged', 'priceChange', 'totalPriceChange', 'cabangChange'];
    public function itemChanged($item_id){
        $this->item_id = $item_id;
        $cabang_id = Auth::user()->role === 'master' ? $this->cabang_id : Auth::user()->cabang->id;
        $this->maxQuantity = StockItem::where('item_id', $item_id)->where('cabang_id', $cabang_id)->where('quantity', '>', 0)->sum('quantity');
        $this->qtyAliases = QtyConverter::where('item_id', $item_id)->orderBy('quantity', 'ASC')->get();
        $this->qtyAlias_id = $this->qtyAliases?->first()?->id;
    }
    public function mount(){
        $this->items = Item::all();
    }
    public function cabangChange($id){
        $this->cabang_id = $id;
        $this->dispatchBrowserEvent('itemSubmited'); // reset item selection
    }
    public function priceChange($val){
        $this->price = intval($val);
        $this->total_price = $this->price * $this->converted_qty;
        $this->dispatchBrowserEvent('total_price-updated');
    }
    public function totalPriceChange($val){
        $this->total_price = intval($val);
        $this->price = $this->total_price / $this->converted_qty;
        $this->dispatchBrowserEvent('price-updated');
    }
    public function updatedQuantity(){
        $satuan_qty = QtyConverter::find($this->qtyAlias_id)->quantity;
        $this->converted_qty = $this->quantity * $satuan_qty;

        $this->total_price = $this->price * $this->quantity;
        $this->dispatchBrowserEvent('total_price-updated');
    }
    public function updatedQtyAliasId(){
        $this->updatedQuantity();
    }
    public function submit(){
        $this->validate([
            'quantity'      => 'required|integer|min:1|max:' . $this->maxQuantity,
            'item_id'       => 'required|exists:items,id',
            'price'         => 'required|integer',
            'total_price'   => 'required|integer'
        ]);
        $item = [
            'id'            => $this->item_id,
            'converted_qty' => $this->converted_qty,
            'satuan_id'     => $this->qtyAlias_id,
            'quantity'      => $this->quantity,
            'price'         => $this->price,
            'total_price'   => $this->total_price,
        ];
        $this->emit('itemSubmit', $item);
        $this->dispatchBrowserEvent('itemSubmited');
        $this->resetExcept('items', 'cabang_id');
    }
    public function render(){
        return view('livewire.trx.sell-entry-online.entry-item');
    }
}
