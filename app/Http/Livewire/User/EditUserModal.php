<?php

namespace App\Http\Livewire\User;

use App\Models\Cabang;
use Illuminate\Support\Str;

use App\Models\User;
use Exception;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditUserModal extends Component {
    use WithFileUploads;
    public $show = false;
    public $data_id, $full_name, $role, $username, $file, $profile_image, $password, $password_confirmation, $cabang_id;
    public $roleSelect = [
        ['value' => 'admin', 'label' => 'Admin'],
        ['value' => 'gudang', 'label' => 'Gudang'],
        ['value' => 'general', 'label' => 'General'],
        ['value' => 'finance', 'label' => 'Finance'],
    ];
    public $cabangSelect;
    public function mount(){
        $this->cabangSelect = Cabang::all();
    }
    protected $listeners = ['openEditModal' => 'openModal'];
    public function openModal($id){
        $this->data_id = $id;
        $user = User::find($id);
        $this->fill($user);
        $this->show = true;
    }
    public function rules(){
        $roleEnum = 'admin,gudang,general,finance';
        return [
            'full_name'         => 'required|string',
            'username'          => ['required', 'string', Rule::unique('users', 'username')->ignore($this->data_id)],
            'file'              => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
            'role'              => "required|in:$roleEnum",
            'cabang_id'         => 'required|exists:cabangs,id',
            'password'          => 'nullable|string|min:8|confirmed',
        ];
    }
    public function update($id){
        $validated = $this->validate();
        if($this->file != null){
            $img_filename = Str::random(40) . '.' . $this->file->getClientOriginalExtension();
            $this->file->storeAs('public/profile', $img_filename);
            $validated['profile_image'] = $img_filename;
        }
        // if($this->password == null){
        //     isset($validated['password']); //prevent error from seeter in user model
        // }
        // dd($validated);
        try{
            $user = User::find($id);
            $user->fill($validated);
            $user->save();
            $this->resetExcept('cabangSelect');
            $this->emit('showSuccessAlert', 'Berhasil Mengupdate Data!');
            $this->emit('refresh_user_table');
            $this->show = false;
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }

    }
    public function render() {
        return view('livewire.user.edit-user-modal');
    }
}
