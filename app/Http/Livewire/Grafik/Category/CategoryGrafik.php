<?php

namespace App\Http\Livewire\Grafik\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryGrafik extends Component{
    public $series, $labels;
    public function mount(){
        $data = Category::withCount(['items as total_item'])->get();
        $this->series = $data->pluck('total_item');
        $this->labels = $data->pluck('name');
    }
    public function render(){
        return view('livewire.grafik.category.category-grafik');
    }
}
