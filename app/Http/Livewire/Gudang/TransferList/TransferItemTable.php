<?php

namespace App\Http\Livewire\Gudang\TransferList;

use App\Models\Cabang;
use App\Models\Category;
use App\Models\Item;
use App\Models\TransferStock;
use Livewire\Component;
use Livewire\WithPagination;

class TransferItemTable extends Component{
    public $user;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_item_table' => 'refresh'];

    public $paginate_count = 50, $data_count;
    public $page = 1; // for page number

    public $status = '0';
    public function mount(){
        $this->resetPage();
        $this->data = $this->getData();
        $this->cabangSelect =  Cabang::all();
        $this->cabang_id = $this->cabangSelect->first()->id;
    }
    public function refresh(){
        $this->resetPage();
        $this->data = $this->getData();
    }
    public function updated(){
        $this->resetPage();
        $this->data = $this->getData();
    }

    // cabang
    public $cabang_id;
    public $cabangSelect;

    public function openAccModal($id){
        $this->emit('openAccModal', $id);
    }
    public function openRejectModal($id){
        $this->emit('openRejectModal', $id);
    }
    // pagging
    protected $data;
    public function updatingPaginateCount() {
        $this->resetPage();
    }
    public function getData(){
        $items = TransferStock::query();
        $items = $items->where('to_cabang_id', $this->cabang_id);
        if($this->status == '0'){
            $items->where('is_acc', false)->where('is_reject', false);
        }
        if($this->status == '1'){
            $items->where('is_acc', true)->where('is_reject', false);
        }
        if($this->status == '2'){
            $items->where('is_acc', false)->where('is_reject', true);
        }
        $this->data_count = $items->count();
        return $items;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.gudang.transfer-list.transfer-item-table', [
            'items' => $this->data->paginate($this->paginate_count)
        ]);
    }
}
