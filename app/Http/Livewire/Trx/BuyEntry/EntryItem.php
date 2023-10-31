<?php

namespace App\Http\Livewire\Trx\BuyEntry;

use App\Models\Item;
use App\Models\QtyConverter;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EntryItem extends Component {
    public $items = [];
    public $item_id, $price, $quantity, $total_price;
    public  $qtyAliases = [], $qtyAlias_id, $converted_qty, $has_exp = false, $exp_date;

    protected $listeners = ['itemChange'];
    public function itemChange($id){
        try{
            $this->item_id = $id;
            $this->qtyAliases = QtyConverter::where('item_id', $id)->orderBy('quantity', 'ASC')->get();
            $this->qtyAlias_id = $this->qtyAliases?->first()?->id;
            $this->quantity = 1;
            $this->has_exp = Item::find($id)->has_expired == 1 ? true : false;
            $this->getConvertedQty();
            $this->getPrice();
        }catch(\Exception $e){}
    }
    public function getConvertedQty(){
        // convert the qty
        try{
            $satuan_qty = QtyConverter::find($this->qtyAlias_id)->quantity;
            $this->converted_qty = intval($this->quantity) * $satuan_qty;
            $price = safeDivision($this->total_price, $this->converted_qty) ;
            $this->price = "Rp. " . number_format($price, 0, ',', '.');
        }catch(\Exception $e){}
    }
    public function updatedTotalPrice(){
        $this->getConvertedQty();
    }
    public function updatedQtyAliasId(){
        $this->getConvertedQty();
        $this->getPrice();
    }
    public function getPrice(){
        try{
            if($this->item_id != null){
                $cabang_id = session()->get('cabang_id', Auth::user()->cabang_id == null ? 1 : 1);
                $price = Item::find($this->item_id)->stocks()->where('cabang_id', $cabang_id)->first()->buying_price;
                $this->price ="Rp. " . number_format($price, 0, ',', '.');
                $this->total_price = $price * $this->converted_qty;
                $this->dispatchBrowserEvent('totalPriceUpdated', ['totalPrice' =>  $this->total_price]);
            }

        }catch(\Exception $e){ }
    }
    public function updatedQuantity(){
        $this->getConvertedQty();
        $this->getPrice();
    }
    public function submit(){
        if($this->has_exp){
            $this->validate([
                'item_id'       => 'required',
                'quantity'      => 'required',
                'qtyAlias_id'   => 'required',
                'total_price'   => 'required',
                'exp_date'      => 'required'
            ]);
        }else{
            $this->validate([
                'item_id'       => 'required',
                'quantity'      => 'required',
                'qtyAlias_id'   => 'required',
                'total_price'   => 'required',
            ]);
        }
        $item = [
            'id'            => $this->item_id,
            'converted_qty' => $this->converted_qty,
            'satuan_id'     => $this->qtyAlias_id,
            'quantity'      => $this->quantity,
            'total_price'   => $this->total_price,
            'price'         => safeDivision($this->total_price, $this->converted_qty),
            'expired_date'  => $this->exp_date
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
