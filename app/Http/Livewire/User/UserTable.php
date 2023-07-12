<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserTable extends Component{
    public $users;
    protected $listeners = ['refresh_user_table' => 'refresh'];

    public function mount(){
        $this->refresh();
    }
    public function refresh(){
        $this->users = User::where('role', '!=', 'master')->get();
    }
    public function render(){
        return view('livewire.user.user-table');
    }
}
