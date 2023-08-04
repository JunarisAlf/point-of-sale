<?php

namespace App\Http\Livewire\Master\Multi;

use App\Models\MultiPrice;
use Exception;
use Livewire\Component;

class EditMultiPriceModal extends Component {
    public $show = false;
    public $data_id, $quantity, $price, $percentage, $multiprice;
    protected $listeners = ['openEditModal' => 'openModal'];
    public function updatedPrice(){
        $this->percentage = 100 - ( $this->price * 100 / $this->multiprice->item->selling_price);
        $this->percentage = number_format($this->percentage, 2, '.', ',');
    }
    public function updatedPercentage(){
        $this->percentage = floatval($this->percentage);
        $this->price = ((100 - $this->percentage) / 100) * $this->multiprice->item->selling_price;
        $this->price = intval($this->price);
        $this->dispatchBrowserEvent('price-updated', ['price' => $this->price]);
    }
    public function openModal($id){
        try {
            $multiprice = MultiPrice::find($id);
            $this->multiprice = $multiprice;
            $this->data_id = $multiprice->id;
            $this->fill($multiprice);
            $this->dispatchBrowserEvent('item-changed', ['price' => $this->price]);
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function rules(){
        return [
            'quantity'          => 'required|integer|min:2',
            'price'             => 'required|integer|min:1',
            'percentage'        => 'required|decimal:0,3'
        ];
    }
    public function update($id){
        $validated = $this->validate();
        try{
            $multiprice = MultiPrice::find($id);
            $multiprice->fill($validated);
            $multiprice->save();
            $this->emit('showSuccessAlert', 'Berhasil Mengedit Data!');
            $this->emit('refresh_multiprice_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render() {
        return view('livewire.master.multi.edit-multi-price-modal');
    }
}
