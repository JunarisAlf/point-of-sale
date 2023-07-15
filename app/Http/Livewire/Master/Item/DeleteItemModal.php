<?php

namespace App\Http\Livewire\Master\Item;

use App\Models\Item;
use Exception;
use Livewire\Component;

class DeleteItemModal extends Component{
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openDeleteModal' => 'openModal'];
    public function openModal($id){
        try {
            $item = Item::find($id);
            $this->data_id = $item->id;
            $this->data_name = $item->name;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function destroy($id){
        try {
            Item::destroy($id);
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_item_table');

        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.master.item.delete-item-modal');
    }
}
