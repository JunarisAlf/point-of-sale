<?php

namespace App\Http\Livewire\Master\Customer;

use App\Models\Customer;
use Exception;
use Livewire\Component;

class CustomerDeleteModal extends Component{
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openDeleteModal' => 'openModal'];
    public function openModal($id){
        try {
            $supplier = Customer::find($id);
            $this->data_id = $supplier->id;
            $this->data_name = $supplier->name;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function destroy($id){
        try {
            Customer::destroy($id);
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_customer_table');

        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.master.customer.customer-delete-modal');
    }
}
