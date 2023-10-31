<?php

namespace App\Http\Livewire\Master\Supplier;

use App\Models\Supplier;
use Exception;
use Livewire\Component;

class CreateSupplierModal extends Component{
    public $show = false;
    public $name, $address, $telp, $sales;
    protected $listeners = ['openCreateModal' => 'openModal'];
    public function openModal(){
        $this->show = true;
    }

    public $rekening = [''];
    public function deleteRek($index){
       unset($this->rekening[$index]);
    }
    public function addRekRow(){
        array_push($this->rekening, '');
    }

    public function rules(){
        return [
            'name'          => 'required|string',
            'address'       => 'required|string',
            'telp'          => 'required|string',
            'rekening'      => 'required|array|min:1',
            'sales'         => 'nullable'
        ];
    }
    public function store(){
        $validated = $this->validate();
        $validated['rekening'] = json_encode($validated['rekening']);
        try{
            Supplier::create($validated);
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('refresh_supplier_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render(){
        return view('livewire.master.supplier.create-supplier-modal');
    }
}
