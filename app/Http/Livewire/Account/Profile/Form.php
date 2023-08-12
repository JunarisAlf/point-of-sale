<?php

namespace App\Http\Livewire\Account\Profile;

use App\Models\User;
use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Form extends Component{
    use WithFileUploads;
    public $profile_img, $name, $user, $file;
    public function mount(){
        $this->user = User::find($this->user->id);
        $this->name = $this->user->full_name;
        $this->profile_img = $this->user->profile_image;
    }
    public function rules(){
        return [
            'name'      => 'required|string',
            'file'      => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ];
    }
    public function update(){
        $this->validate();
        try{
            $user = User::find($this->user->id);
            if($this->file !== null){
                $img_filename = Str::random(40) . '.' . $this->file->getClientOriginalExtension();
                $this->file->storeAs('public/profile', $img_filename);
                $user->profile_image = $img_filename;
            }
            $user->full_name = $this->name;
            $user->save();
            $this->mount();
            $this->emit('showSuccessAlert', 'Berhasil Mengupdate Data!');
            $this->mount();
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render(){
        return view('livewire.account.profile.form');
    }
}
