<?php

namespace App\Http\Livewire\Trx\SellEntryRev;

use App\Models\Item;
use App\Models\QtyConverter;
use App\Models\StockItem;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EntryTable extends Component{
    public $items = [];
    protected $listeners = ['itemSubmit' => 'addItem'];
    public function mount(){
        $this->items = session()->get('entry-item', [], 10);
    }

    public function addItem($item){
        $index = custom_array_search($this->items, $item['id']);
        $itemData = Item::find($item['id']);
        $item['name'] = $itemData->name;
        if($index !== false){
            $this->items[$index]['quantity'] += 1;
        }else{
            array_push($this->items, $item);
        }
        $this->updatedItems();

    }
    public function updatedItems(){
        $errors = $this->getErrorBag();
        $keys = array_keys($this->items);
        $this->items = array_map(function($i, $key) use($errors){
            $converted_qty = $i['quantity'] * QtyConverter::find($i['satuan_id'])->quantity;
            $item = Item::find($i['id']);
            $multiprice = $item->prices()->where('quantity', '<=', $converted_qty)->orderByDesc('quantity')->first();
            $price = $multiprice == null ? $item->selling_price : $multiprice->price;

            $cabang_id = Auth::user()->cabang?->id == null ? 1 : Auth::user()->cabang->id;
            $maxQuantity = StockItem::where('item_id', $i['id'])->where('cabang_id', $cabang_id)->where('quantity', '>', 0)->sum('quantity');
            if( $converted_qty >  $maxQuantity){
                $errors->add('quantity-' . $key, 'Out Of Stock');
            }
            return [
                'id'            => $i['id'],
                'name'          => $i['name'],
                'quantity'      => $i['quantity'],
                'satuan_id'     => $i['satuan_id'],
                'converted_qty' => $converted_qty ,
                'discount'      => $i['discount'],
                'price'         => $price,
                'total_price'   => ($price * $converted_qty) - intval( $i['discount']),
                'stock'         => $maxQuantity
            ];
        }, $this->items, $keys);
        session()->put('entry-item', $this->items);
        $this->updateGrandPrice();
    }
    public function removeItem($id){
        $index = custom_array_search($this->items, $id);
        unset($this->items[$index]);
        session()->put('entry-item', $this->items);
        $this->updateGrandPrice();
    }

    public function updateGrandPrice(){
        $totalSum = array_reduce($this->items, function ($carry, $item) {
            return $carry + $item['total_price'];
        }, 0);
        $subTotal = array_reduce($this->items, function ($carry, $item) {
            return $carry + ($item['converted_qty'] * $item['price']) ;
        }, 0);
        $totalDisc = array_reduce($this->items, function ($carry, $item) {
            return $carry + $item['discount'];
        }, 0);
        $this->emit('grandPriceUpdate', compact('totalSum', 'totalDisc', 'subTotal'));
    }

    public function store(){
        $this->updatedItems();
        $errors = $this->getErrorBag();
        if($errors->isEmpty()){
            $this->emit('validateMetaInfo', $this->items);
        }else{
            $this->emit('showDangerAlert', 'Out Of Stock!');
        }
    }
    public function render(){
        return view('livewire.trx.sell-entry-rev.entry-table');
    }
}
