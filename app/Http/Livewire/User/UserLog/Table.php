<?php

namespace App\Http\Livewire\User\UserLog;

use App\Models\UserLog;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate_count = 50, $data_count;
    private $data;

    public function updatingPaginateCount() {
        $this->resetPage();
    }
    public function mount(){
        $this->data = UserLog::latest()->get();
    }
    public function getData(){
        $data = UserLog::latest();
        $this->data_count = $data->count();
        return $data;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.user.user-log.table', [
            'loginLogs' => $this->data->paginate($this->paginate_count)
        ]);
    }
}
