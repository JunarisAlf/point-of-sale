<?php

namespace App\Http\Livewire\Gudang\Expired;

use App\Models\Cabang;
use App\Models\Category;
use App\Models\Item;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ExpiredTable extends Component{
    public $user;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_item_table' => 'mount', 'categoryChange'];

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
        $this->mount();
    }

    // CountDown
    public $countdown = 0;
    public $countDowns = [
        ['name' => 'Semua Waktu', 'days'  => 0],
        ['name' => '1 Minggu Akan Datang', 'days'  => 7],
        ['name' => '1 Bulan Akan Datang', 'days'  => 30],
        ['name' => '2 Bulan Akan Datang', 'days'  => 60],
        ['name' => '3 Bulan Akan Datang', 'days'  => 90],
        ['name' => '4 Bulan Akan Datang', 'days'  => 120],
    ];
    public function mount(){
        $this->resetPage();
        $this->data = $this->getData();
        $this->categorySelect = Category::all();
        $this->cabangSelect =  Cabang::all();
        $this->cabang_id = $this->cabangSelect->first()->id;
        // dd($this->data->get());
    }
    public function updated(){
        $this->resetPage();
        $this->data = $this->getData();
    }
    // category
    public $category;
    public $categorySelect;
    public function categoryChange($id){
        $this->category = $id;
        $this->mount();
    }
    // cabang
    public $cabang_id;
    public $cabangSelect;

    // sort
    public $shortField = 0;
    public $shortableField = [
        ['field' => 'name',          'short' => 'ASC', 'label'  => 'Nama Barang - Menaik'],
        ['field' => 'name',          'short' => 'DESC', 'label' => 'Nama Barang - Menurun'],
        ['field' => 'quantity_sum',  'short' => 'ASC', 'label'  => 'Jumlah Stok - Menaik'],
        ['field' => 'quantity_sum',  'short' => 'DESC','label'  => 'Jumlah Stok - Menurun'],
    ];

    // pagging
    protected $data;
    public function updatingPaginateCount() {
        $this->resetPage();
    }
    public function getData(){
        $items = Item::query();
        $cabangId = $this->cabang_id;
        $items =
            Item::
                where('has_expired', true)
                ->withSum(['stocks as quantity_sum' => function ($query) use ($cabangId) {
                    $query->where('cabang_id', $cabangId);
                }], 'quantity');
        // countdown
            $date = Carbon::now()->addDays(intval($this->countdown))->format('Y-m-d');
            $items->with(['stocks' => function($query) use ($cabangId, $date){
                $query->where('cabang_id', $cabangId);
                if($this->countdown != 0){
                    $query->whereDate('expired_date', '<=', $date);
                }
            }]);
        if($this->searchQuery !== null && $this->searchField !== null){
            $items->where($this->searchableField[$this->searchField]['value'], 'like', "%$this->searchQuery%");
        }

        // ORDER
        $shortRule = $this->shortableField[$this->shortField];
        $items->orderBy($shortRule['field'], $shortRule['short']);
        $this->data_count = $items->count();
        return $items;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.gudang.expired.expired-table', [
            'items' => $this->data->paginate($this->paginate_count)
        ]);
    }
}
