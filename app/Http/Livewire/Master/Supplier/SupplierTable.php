<?php

namespace App\Http\Livewire\Master\Supplier;

use App\Models\Item;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierTable extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_supplier_table' => 'mount'];

    public $paginate_count = 10, $data_count;
    public $page = 1; // for page number
    // search
    public $searchQuery = '';

    public function mount(){
        $this->resetPage();
        $this->data = $this->getData();
    }
    // pagging
    protected $data;
    public function updatingPaginateCount() {
        $this->resetPage();
    }

    public function getData(){
        $suppliers =
            Supplier::
                    where('name', 'like', "%$this->searchQuery%")
                    ->orWhere('address', 'like', "%$this->searchQuery%")
                    ->orWhere('telp', 'like', "%$this->searchQuery%")
                    ->orWhere('address', 'like', "%$this->searchQuery%")
                    ->orderBy('id', 'DESC');
        $this->data_count = $suppliers->count();
        return $suppliers;
    }

    public function render(){
        $this->data = $this->getData();
        return view('livewire.master.supplier.supplier-table', [
            'suppliers' => $this->data->paginate($this->paginate_count)
        ]);
    }
}
