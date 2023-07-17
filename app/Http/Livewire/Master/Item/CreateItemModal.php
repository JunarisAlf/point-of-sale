<?php

namespace App\Http\Livewire\Master\Item;

use App\Models\Category;
use App\Models\Item;
use Exception;
use Livewire\Component;
use Ramsey\Uuid\Type\Integer;

class CreateItemModal extends Component{
    public $show = false;
    public $name, $category, $category_id, $has_expired, $selling_price;
    public $categoriesSelect ;
    public function mount(){
        $this->categoriesSelect = Category::orderBy('name', 'DESC')->get();
    }
  
    protected $listeners = ['openCreateModal' => 'openModal', 'categoryChange', 'createSellingPriceChange'];
    public function openModal(){
        $this->show = true;
    }
    public function categoryChange($val){
        $this->category_id = $val;
    }
    public function createSellingPriceChange($val){
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
    public function store(){
        $validated = $this->validate();
        try{
            Item::create($validated);
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('refresh_item_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->resetExcept('categoriesSelect');
    }
    public function render() {
        return view('livewire.master.item.create-item-modal');
    }
}
