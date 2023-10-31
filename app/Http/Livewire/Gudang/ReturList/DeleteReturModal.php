<?php

namespace App\Http\Livewire\Gudang\ReturList;

use App\Models\Item;
use App\Models\Retur;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DeleteReturModal extends Component {
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openDeleteModal' => 'openModal'];
    public function openModal($id){
        try {
            $retur = Retur::find($id);
            $this->data_id = $retur->id;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function destroy($id){
        DB::beginTransaction();
        try {
            $retur = Retur::find($id);
            if($retur->type == 'ke-supplier'){
                foreach($retur->details as $detail){
                    $stock = Item::find($detail->item_id)->stocks()->where('cabang_id', $retur->cabang_id)->first();
                    $stock->quantity += $detail->quantity;
                    $stock->save();
                }
            }else{
                foreach($retur->details as $detail){
                    $stocks = Item::find($detail->item_id)->stocks()->where('cabang_id', $retur->cabang_id)->get();
                    $quantity_retur = $detail->quantity;
                    foreach ($stocks as $key => $stock) {
                        if($stock->quantity >= $quantity_retur){
                            $stock->quantity -= $quantity_retur;
                            $stock->save();
                            break;
                        }else{
                            $quantity_retur -= $stock->quantity;
                            $stock->quantity = 0;
                            $stock->save();
                        }
                    }
                }
            }
            $retur->delete();
            DB::commit();
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_retur_table');

        } catch (Exception $e) {
            DB::rollBack();
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render() {
        return view('livewire.gudang.retur-list.delete-retur-modal');
    }
}
