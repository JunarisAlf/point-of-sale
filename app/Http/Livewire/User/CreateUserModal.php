<?php

namespace App\Http\Livewire\User;

use App\Models\Cabang;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;

use Livewire\Component;
use Livewire\WithFileUploads;

class CreateUserModal extends Component{
    use WithFileUploads;
    public $show = false;
    public  $full_name, $role, $username, $file, $password, $password_confirmation, $cabang_id;
    public $roleSelect = [
        ['value' => 'admin', 'label' => 'Admin'],
        ['value' => 'gudang', 'label' => 'Gudang'],
        ['value' => 'general', 'label' => 'General'],
    ];
    public $cabangSelect;
    public function mount(){
        $this->cabangSelect = Cabang::all();
    }
    protected $listeners = ['openCreateModal' => 'openModal'];
    public function openModal(){
        $this->show = true;
    }
    public function rules(){
        $roleEnum = 'admin,gudang,general';
        return [
            'full_name'         => 'required|string',
            'username'          => 'required|string|unique:users,username',
            'file'              => 'required|image|mimes:jpeg,png,jpg|max:1024',
            'role'              => "required|in:$roleEnum",
            'cabang_id'         => 'required|exists:cabangs,id',
            'password'          => 'required|string|min:8|confirmed',
        ];
    }
    public function store(){
        $validated = $this->validate();
        $img_filename = Str::random(40) . '.' . $this->file->getClientOriginalExtension();
        $this->file->storeAs('public/profile', $img_filename);
        $validated['profile_image'] = $img_filename;
        try{
            User::create($validated);
            $this->resetExcept('cabangSelect');
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $this->emit('refresh_user_table');
            $this->show = false;
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
        
    }
    public function render(){
        return view('livewire.user.create-user-modal');
    }
}
