<?php

namespace App\Http\Livewire\Auth\LoginPage;

use App\Models\UserLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component{
    public $username, $password;
    public function login(){
        $validated = $this->validate([
            'username'      => 'required|string',
            'password'      => 'required|string'
        ]);

        if (Auth::attempt($validated)) {
            session()->regenerate();
            UserLog::create(['user_id' => Auth::user()->id]);
            if(Auth::user()->role == 'master'){
                return to_route('admin.dashboard');
            }else{
                return to_route('profile');
            }
        }
        $this->resetExcept('username');
        session()->flash('error', 'Login Gagal! Username atau Password Salah!');
    }
    public function render(){
        return view('livewire.auth.login-page.form');
    }
}
