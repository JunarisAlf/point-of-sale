<?php

namespace App\Http\Livewire\Master\Multi;

use App\Models\Item;
use Exception;
use Livewire\Component;

class CreateMultiPriceModal extends Component {
    public $show = false;
    public $item_id, $quantity, $price, $percentage, $item;
    protected $listeners = ['openCreateModal' => 'openModal'];
    public function openModal($id){
        $this->item_id = $id;
        $this->item = Item::find($id);
        $this->show = true;
    }
    public function updatedPrice(){
        $this->percentage = 100 - ( $this->price * 100 / $this->item->selling_price);
        $this->percentage = number_format($this->percentage, 2, '.', ',');
    }
    public function updatedPercentage(){
        $this->percentage = floatval($this->percentage);
        $this->price = ((100 - $this->percentage) / 100) * $this->item->selling_price;
        $this->price = intval($this->price);
        $this->dispatchBrowserEvent('price-updated', ['price' => $this->price]);
    }
    public function rules(){
        return [
            'quantity'          => 'required|integer|min:2',
            'price'             => 'required|integer|min:1',
            'percentage'        => 'required|decimal:0,3'
        ];
    }
    public function store(){
        $validated = $this->validate();
        try{
            $item = Item::find($this->item_id);
            $item->prices()->create($validated);
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('refresh_multiprice_table');
            $this->show = false;
            $this->dispatchBrowserEvent('price-updated', ['price' => $this->price]);
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render() {
        return view('livewire.master.multi.create-multi-price-modal');
    }
}
