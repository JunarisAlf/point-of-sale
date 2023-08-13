<?php

namespace App\Http\Livewire\Setting\OtherInfo;

use App\Models\KeyValue;
use Exception;
use Livewire\Component;

class Form extends Component{
    public $runing_text, $login_text;
    public function mount(){
        $this->login_text = KeyValue::where('key', 'login_text')->first()->value;
        $this->runing_text = KeyValue::where('key', 'runing_text')->first()->value;
    }
    public function update(){
        try{
            KeyValue::where('key', 'login_text')->update(['value' => $this->login_text]);
            KeyValue::where('key', 'runing_text')->update(['value' => $this->runing_text]);
            $this->emit('showSuccessAlert', 'Berhasil Mengupdate Data!');
            $this->mount();
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        
    }
    public function render(){
        return view('livewire.setting.other-info.form');
    }
}
