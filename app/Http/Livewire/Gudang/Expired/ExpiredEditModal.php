<?php

namespace App\Http\Livewire\Gudang\Expired;

use App\Models\StockItem;
use Livewire\Component;

class ExpiredEditModal extends Component{
    public $show = false, $data_id, $expired_date;
    protected $listeners = ['openExpDateEditModal'];
    public function openExpDateEditModal($id){
        $this->show = true;
        $this->data_id = $id;
        $stockItem = StockItem::find($this->data_id);
        $this->expired_date =  $stockItem->expired_date;
    }
    public function dateInputed($date){
        $this->expired_date = $date;
    }
    public function update(){
        $stockItem = StockItem::find($this->data_id);
        $stockItem->expired_date = $this->expired_date;
        $stockItem->save();
        $this->show = false;
        $this->emit('showSuccessAlert', 'Berhasil Mengedit Data!');
        $this->emit('refresh_item_table');
    }
    public function render(){
        return view('livewire.gudang.expired.expired-edit-modal');
    }
}
