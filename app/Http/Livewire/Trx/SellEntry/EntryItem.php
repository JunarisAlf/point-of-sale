<?php

namespace App\Http\Livewire\Trx\SellEntry;

use App\Models\Item;
use Livewire\Component;

class EntryItem extends Component{
    public $items;
    public $quantity, $item_id, $price, $total_price, $discount = 0, $percentage = 0;
    protected $listeners = ['itemChanged', 'discountChange'];
    public function itemChanged($item_id){
        $this->item_id = $item_id;
        $this->discount = 0;
        $this->dispatchBrowserEvent('discount-updated');
        $this->updatedQuantity();
    }
    public function updatedPercentage(){
        $this->percentage = $this->percentage == null ? 0 : floatval($this->percentage);

        //get original total price
        if($this->item_id !== null && $this->quantity !== null){
            $item = Item::find($this->item_id);
            $multiprice = $item->prices()->where('quantity', '<=', $this->quantity)->orderByDesc('quantity')->first();
            $this->price = $multiprice == null ? $item->selling_price : $multiprice->price;
            $this->total_price = $this->price * $this->quantity;
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
            $multiprice = $item->prices()->where('quantity', '<=', $this->quantity)->orderByDesc('quantity')->first();
            $this->price = $multiprice == null ? $item->selling_price : $multiprice->price;
            $this->total_price = $this->price * $this->quantity;
        }
        
        $this->discount = $disc;
        $this->percentage = $this->discount * 100 / $this->total_price;
        $this->percentage = number_format($this->percentage, 2, '.', ',');
        $this->total_price = $this->total_price - $this->discount;
        $this->dispatchBrowserEvent('total_price-updated');
    }
    public function updatedQuantity(){
        if($this->item_id !== null && $this->quantity !== null){
            $item = Item::find($this->item_id);
            $multiprice = $item->prices()->where('quantity', '<=', $this->quantity)->orderByDesc('quantity')->first();
            $this->price = $multiprice == null ? $item->selling_price : $multiprice->price;
            $this->dispatchBrowserEvent('price-updated');
            $this->total_price = ($this->price * $this->quantity) - $this->discount;
            $this->dispatchBrowserEvent('total_price-updated');
        }
    }
    public function mount(){
        $this->items = Item::all();
    }

    public function submit(){
        $item = [
            'id'            => $this->item_id, 
            'quantity'      => $this->quantity, 
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
