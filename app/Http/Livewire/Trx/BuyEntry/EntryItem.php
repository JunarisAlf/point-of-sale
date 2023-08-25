<?php

namespace App\Http\Livewire\Trx\BuyEntry;

use App\Models\Item;
use App\Models\QtyConverter;
use Livewire\Component;

class EntryItem extends Component {
    public $items = [];
    public $item_id, $price, $quantity, $total_price;
    public  $qtyAliases = [], $qtyAlias_id, $converted_qty;

    protected $listeners = ['itemChange'];
    public function itemChange($id){
        $this->item_id = $id;
        $this->qtyAliases = QtyConverter::where('item_id', $id)->orderBy('quantity', 'ASC')->get();
        $this->qtyAlias_id = $this->qtyAliases?->first()?->id;
    }
    public function updated(){
        // convert the qty
        $satuan_qty = QtyConverter::find($this->qtyAlias_id)->quantity;
        $this->converted_qty = $this->quantity * $satuan_qty;

        $price = $this->total_price / $this->converted_qty;
        $this->price = "Rp. " . number_format($price, 0, ',', '.');
    }
    public function submit(){
        $item = [
            'id'            => $this->item_id,
            'converted_qty' => $this->converted_qty,
            'satuan_id'     => $this->qtyAlias_id,
            'quantity'      => $this->quantity,
            'total_price'   => $this->total_price,
            'price'         => $this->total_price / $this->converted_qty
        ];
        $this->emit('itemSubmit', $item);
        $this->dispatchBrowserEvent('itemSubmited');
        $this->reset();
    }
    public function mount(){
        $this->items = Item::all();
    }
    public function render() {
        return view('livewire.trx.buy-entry.entry-item');
    }
}
