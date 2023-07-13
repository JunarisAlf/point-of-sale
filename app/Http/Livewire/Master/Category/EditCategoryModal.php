<?php

namespace App\Http\Livewire\Master\Category;

use App\Models\Category;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditCategoryModal extends Component{
    public $show = false;
    public $data_id, $name;
    protected $listeners = ['openEditModal' => 'openModal'];
    public function openModal($id){
        try {
            $category = Category::find($id);
            $this->data_id = $category->id;
            $this->name = $category->name;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function rules(){
        return [
            'name'      => ['required', 'string', Rule::unique('categories', 'name')->ignore($this->data_id)],
        ];
    }
    public function update($id){
        $validated = $this->validate();
        try{
            $category = Category::find($id);
            $category->fill($validated);
            $category->save();
            $this->emit('showSuccessAlert', 'Berhasil Mengedit Data!');
            $this->emit('refresh_category_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render(){
        return view('livewire.master.category.edit-category-modal');
    }
}
