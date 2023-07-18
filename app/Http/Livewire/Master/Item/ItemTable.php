<?php

namespace App\Http\Livewire\Master\Item;

use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ItemTable extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_item_table' => 'mount'];

    public $paginate_count = 50, $data_count;
    public $page = 1; // for page number
    // search
    public $searchQuery;
    public $searchField = 0;
    public $searchableField = [
        ['value' => 'name',     'label' => 'Nama'],
        ['value' => 'barcode',  'label' => 'Barode'],
    ];
    public function searchFieldChange($key){
        $this->searchField = $key;
        $this->searchQuery = '';
        $this->dispatchBrowserEvent('generate-barcode'); 

    }
   
    public function mount(){
        $this->resetPage();
        $this->data = $this->getData();
        $this->categorySelect = Category::all();
        $this->dispatchBrowserEvent('generate-barcode'); 
    }

    // category
    public $category;
    public $categorySelect;
    
    // expiredable
    public $has_expired;
    
    // sort
    public $shortField = 0;
    public $shortableField = [
        ['field' => 'updated_at',    'short' => 'DESC', 'label'  => 'Terbaru'],
        ['field' => 'updated_at',    'short' => 'ASC', 'label'  => 'Terlama'],
        ['field' => 'name',          'short' => 'ASC', 'label'  => 'Nama Barang - Menaik'],
        ['field' => 'name',          'short' => 'DESC', 'label' => 'Nama Barang - Menurun'],
        ['field' => 'selling_price', 'short' => 'ASC', 'label'  => 'Harga - Termurah'],
        ['field' => 'selling_price', 'short' => 'DESC','label'  => 'Harga - Termahal'],
    ];

    // pagging
    protected $data;
    public function updatingPaginateCount() {
        $this->resetPage();
    }
   
    
    public function getData(){
        $items = Item::query();
        if($this->searchQuery !== null && $this->searchField !== null){
            $items = $items->where($this->searchableField[$this->searchField]['value'], 'like', "%$this->searchQuery%");
        }
        if($this->has_expired !== null && $this->has_expired !== 'all'){
            $items->where('has_expired', $this->has_expired);
        }
        if($this->category !== null && $this->category !== 'all'){
            $items->where('category_id', $this->category);
        }
        // ORDER
        $shortRule = $this->shortableField[$this->shortField];
        $items->orderBy($shortRule['field'], $shortRule['short']);
        $this->data_count = $items->count();
        return $items;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.master.item.item-table', [
            'items' => $this->data->paginate($this->paginate_count)
        ]);
    }
  
}
