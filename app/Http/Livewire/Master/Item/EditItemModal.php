<?php

namespace App\Http\Livewire\Master\Item;

use App\Models\Category;
use App\Models\Item;
use Exception;
use Livewire\Component;

class EditItemModal extends Component {
    public $show = false;
    public $data_id;
    public $name, $category, $category_id, $has_expired, $selling_price;
    public $categoriesSelect ;
    public function mount(){
        $this->categoriesSelect = Category::orderBy('name', 'DESC')->get();
    }
    protected $listeners = ['openEditModal' => 'openModal', 'categoryChange', 'sellingPriceChange'];
    public function openModal($id){
        try {
            $item = Item::find($id);
            $this->data_id = $item->id;
            $this->fill($item);
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function categoryChange($val){
        $this->category_id = $val;
    }
    public function sellingPriceChange($val){
        $this->selling_price = $val;
    }
    public function rules(){
        return [
            'name'          => 'required|string',
            'category_id'   => 'required|exists:categories,id',
            'has_expired'   => 'required|boolean',
            'selling_price' => 'required|integer|min:0',
        ];
    }
    public function update($id){
        $validated = $this->validate();
        try{
            $item = Item::find($id);
            $item->fill($validated);
            $item->save();
            $this->emit('showSuccessAlert', 'Berhasil Mengedit Data!');
            $this->emit('refresh_item_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->resetExcept('categoriesSelect');
    }
    public function render() {
        return view('livewire.master.item.edit-item-modal');
    }
}
