<?php

namespace App\Http\Livewire\Master\GeneralInfo;

use App\Models\KeyValue;
use Exception;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Form extends Component{
    use WithFileUploads;
    public $name, $wa, $address, $email, $file;
    public $keyValues;
    public function mount(){
        $this->keyValues = KeyValue::all();
        $this->name = $this->keyValues->where('key', 'toko_name')->first()->value;
        $this->wa = $this->keyValues->where('key', 'toko_wa')->first()->value;
        $this->address = $this->keyValues->where('key', 'toko_address')->first()->value;
        $this->email = $this->keyValues->where('key', 'toko_email')->first()->value;
    }
    public function rules(){
        return [
            'name'      => 'required|string',
            'wa'        => 'required|string',
            'address'   => 'required|string',
            'email'     => 'required|string',
            'file'      => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ];
    }
    public function update(){
        $this->validate();
        
    
        try{
            if($this->file !== null){
                $img_filename = Str::random(40) . '.' . $this->file->getClientOriginalExtension();
                $this->file->storeAs('public/images', $img_filename);
                KeyValue::where('key', 'toko_logo')->update(['value' => $img_filename]);
            }
            KeyValue::where('key', 'toko_name')->update(['value' => $this->name]);
            KeyValue::where('key', 'toko_wa')->update(['value' => $this->wa]);
            KeyValue::where('key', 'toko_address')->update(['value' => $this->address]);
            KeyValue::where('key', 'toko_email')->update(['value' => $this->email]);

            $this->emit('showSuccessAlert', 'Berhasil Mengupdate Data!');
            $this->mount();
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }

    }
    public function render(){
        return view('livewire.master.general-info.form');
    }
}
