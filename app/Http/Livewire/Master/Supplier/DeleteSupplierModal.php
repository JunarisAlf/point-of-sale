<?php

namespace App\Http\Livewire\Master\Supplier;

use App\Models\Supplier;
use Exception;
use Livewire\Component;

class DeleteSupplierModal extends Component{
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openDeleteModal' => 'openModal'];
    public function openModal($id){
        try {
            $supplier = Supplier::find($id);
            $this->data_id = $supplier->id;
            $this->data_name = $supplier->name;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function destroy($id){
        try {
            Supplier::destroy($id);
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_supplier_table');

        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.master.supplier.delete-supplier-modal');
    }
}
