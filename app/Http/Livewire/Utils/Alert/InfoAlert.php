<?php

namespace App\Http\Livewire\Utils\Alert;

use Livewire\Component;

class InfoAlert extends Component{
    public $message = "ok", $show = false;
    protected $listeners = ['showInfoAlert' => 'show'];
    public function show($message){
        $this->show = true;
        $this->message = $message;
        $this->dispatchBrowserEvent('auto-hide');
    }
    public function render(){
        return view('livewire.utils.alert.info-alert');
    }
}
