<?php

namespace App\Http\Livewire\Account;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ChangePassword extends Component{
    public $user;
    public $old_password, $new_password, $new_password_confirmation;

    public function rules(){
        return [
            'old_password'      => 'required|string',
            'new_password'      => 'required|string|min:8|confirmed',
            // 'new_password_confirmation' => 'required|string|min:8'
        ];
    }
    public function submitForm(){
        if(!Hash::check($this->old_password, $this->user->password)){
            $this->addError('old_password', 'Password salah');
            return;
        }
        $this->validate();
        $this->user->password = $this->new_password;
        $this->user->save();
        return to_route('logout');
    }
    public function render(){
        return view('livewire.account.change-password');
    }
}
