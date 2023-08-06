<?php

namespace App\Http\Livewire\Master\Customer;

use App\Models\Customer;
use Exception;
use Livewire\Component;

class CustomerEditModal extends Component{
    public $show = false;
    public $data_id, $name, $address, $wa, $gender;
    protected $listeners = ['openEditModal' => 'openModal'];

    public function openModal($id){
        try {
            $supplier = Customer::find($id);
            $this->data_id = $supplier->id;
            $this->fill($supplier);
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function rules(){
        return [
            'name'          => 'required|string',
            'address'       => 'required|string',
            'wa'            => 'required|string',
            'gender'        => 'required|string'
        ];
    }
    public function update($id){
        $validated = $this->validate();
        try{
            $supplier = Customer::find($id);
            $supplier->fill($validated);
            $supplier->save();
            $this->emit('showSuccessAlert', 'Berhasil Mengedit Data!');
            $this->emit('refresh_customer_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render(){
        return view('livewire.master.customer.customer-edit-modal');
    }
}
