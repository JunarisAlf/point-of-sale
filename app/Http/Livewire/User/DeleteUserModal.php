<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Exception;
use Livewire\Component;

class DeleteUserModal extends Component {
    public $show = false;
    public $data_id, $data_name;
    protected $listeners = ['openDeleteModal' => 'openModal'];
    public function openModal($id){
        try {
            $user = User::find($id);
            $this->data_id = $user->id;
            $this->data_name = $user->username;
            $this->show = true;
        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function destroy($id){
        try {
            User::destroy($id);
            $this->show = false;
            $this->emit('showSuccessAlert', 'Data Berhasil Dihapus!');
            $this->emit('refresh_user_table');

        } catch (Exception $e) {
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render() {
        return view('livewire.user.delete-user-modal');
    }
}
