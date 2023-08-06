<?php

namespace App\Http\Livewire\Master\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerTable extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_customer_table' => 'mount'];

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
        $customers = 
            Customer::
                    where('name', 'like', "%$this->searchQuery%")
                    ->orWhere('address', 'like', "%$this->searchQuery%")
                    ->orWhere('wa', 'like', "%$this->searchQuery%")
                    ->orWhere('address', 'like', "%$this->searchQuery%");
        return $customers;
    }

    public function render(){
        $this->data = $this->getData();
        return view('livewire.master.customer.customer-table', [
            'customers' => $this->data->paginate($this->paginate_count)
        ]);
    }
}
