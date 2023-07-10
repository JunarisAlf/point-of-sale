<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class CreateUserModal extends Component{
    public $show = false;
    protected $listeners = ['openCreateModal' => 'openModal'];
    public function openModal(){
        $this->show = true;
    }
    public function render(){
        return view('livewire.user.create-user-modal');
    }
}
