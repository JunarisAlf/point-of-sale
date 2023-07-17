<?php

namespace App\Http\Livewire\Master\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryTable extends Component{
    public $categories;
    protected $listeners = ['refresh_category_table' => 'refresh'];
    public function mount(){
        $this->categories = Category::withCount('items')->latest()->get();
    }
    public function refresh(){
        $this->categories = Category::withCount('items')->latest()->get();
    }
    public function render(){
        return view('livewire.master.category.category-table');
    }
}
