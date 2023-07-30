<?php

namespace App\Http\Livewire\Gudang\Opname;

use App\Models\StockItem;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class OpnameModal extends Component{
    public $show = false;
    public $data_id, $name, $quantity;
    protected $listeners = ['openEditModal' => 'openModal', 'dateChanged'];
    public function openModal($id){
        try {
            $stockItem = StockItem::find($id);
            $this->data_id = $stockItem->id;
            $this->name = $stockItem->item->name;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function rules(){
        return [
            'quantity'   => 'required|integer|min:0',
        ];
    }
    public function mount(){
        $this->opname_date = Carbon::now()->format('Y-m-d');
    }
    public $opname_date;
    public function dateChanged($date){
        $this->opname_date = $date;
    }
    public function submit($id){
        $validated = $this->validate();
        try{
            $user = auth()->user();
            $stockItem = StockItem::find($id);
            $stockItem->opnames()->create([
                'date'          => $this->opname_date,
                'user_id'       => $user->id,
                'old_quantity'  => $stockItem->quantity,
                'quantity'      => $validated['quantity']
            ]);
            $this->emit('refresh_item_table');
            $this->emit('showSuccessAlert', 'Aksi Berhasil Dilakukan!');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render() {
        return view('livewire.gudang.opname.opname-modal');
    }
}
