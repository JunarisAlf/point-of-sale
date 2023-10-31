<?php

namespace App\Http\Livewire\Master\Supplier;

use App\Models\Supplier;
use Exception;
use Livewire\Component;

class EditSupplierModal extends Component{
    public $show = false;
    public $data_id, $name, $address, $telp, $sales;
    protected $listeners = ['openEditModal' => 'openModal'];

    public $rekening = [''];
    public function deleteRek($index){
       unset($this->rekening[$index]);
    }
    public function addRekRow(){
        array_push($this->rekening, '');
    }


    public function openModal($id){
        try {
            $supplier = Supplier::find($id);
            $this->data_id = $supplier->id;
            $this->fill($supplier);
            $this->rekening = json_decode($supplier->rekening == null ? '[]' : $supplier->rekening);
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
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
    public function update($id){
        $validated = $this->validate();
        $validated['rekening'] = json_encode($validated['rekening']);
        try{
            $supplier = Supplier::find($id);
            $supplier->fill($validated);
            $supplier->save();
            $this->emit('showSuccessAlert', 'Berhasil Mengedit Data!');
            $this->emit('refresh_supplier_table');
            $this->show = false;

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        $this->reset();
    }
    public function render(){
        return view('livewire.master.supplier.edit-supplier-modal');
    }
}
