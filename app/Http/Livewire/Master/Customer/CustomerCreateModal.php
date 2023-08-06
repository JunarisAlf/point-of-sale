<?php

namespace App\Http\Livewire\Master\Customer;

use App\Models\Customer;
use Exception;
use Livewire\Component;

class CustomerCreateModal extends Component{
    public $show = false;
    public $name, $address, $wa, $gender;
    protected $listeners = ['openCreateModal' => 'openModal'];
    public function openModal(){
        $this->show = true;
    }
    public function rules(){
        return [
            'name'          => 'required|string',
            'address'       => 'required|string',
            'wa'            => 'required|string',
            'gender'        => 'required|string'
        ];
    }
    public function store(){
        $validated = $this->validate();
        try{
            Customer::create($validated);
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('refresh_customer_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render(){
        return view('livewire.master.customer.customer-create-modal');
    }
}
