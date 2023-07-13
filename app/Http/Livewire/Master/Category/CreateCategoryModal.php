<?php

namespace App\Http\Livewire\Master\Category;

use App\Models\Category;
use Exception;
use Livewire\Component;

class CreateCategoryModal extends Component{
    public $show = false;
    public $name;
    protected $listeners = ['openCreateModal' => 'openModal'];
    public function openModal(){
        $this->show = true;
    }
    public function rules(){
        return [
            'name'      => 'required|string|unique:categories,name',
        ];
    }
    public function store(){
        $validated = $this->validate();
        try{
            Category::create($validated);
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('refresh_category_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render(){
        return view('livewire.master.category.create-category-modal');
    }
}
