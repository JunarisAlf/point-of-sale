<?php

namespace App\Http\Livewire\Utils\Alert;

use Livewire\Component;

class SuccessAlert extends Component{
    public $message = "ok", $show = false;
    protected $listeners = ['showSuccessAlert' => 'show'];
    public function show($message){
        $this->show = true;
        $this->message = $message;
        $this->dispatchBrowserEvent('auto-hide');
    }
    public function render(){
        return view('livewire.utils.alert.success-alert');
    }
}
