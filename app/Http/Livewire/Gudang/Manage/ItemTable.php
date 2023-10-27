<?php

namespace App\Http\Livewire\Gudang\Manage;

use App\Models\Cabang;
use App\Models\Category;
use App\Models\Item;
use Livewire\Component;
use Livewire\WithPagination;

class ItemTable extends Component{
    public $user;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_item_table' => 'mount'];

    public $paginate_count = 50, $data_count;
    public $page = 1; // for page number
    // search
    public $searchQuery = '';


    public function mount(){
        $this->resetPage();
        $this->data = $this->getData();
        $this->cabangSelect =  Cabang::all();
        $this->cabang_id = $this->cabangSelect->first()->id;
        // dd($this->data->get());
    }
    public function updated(){
        $this->resetPage();
        $this->data = $this->getData();
    }

    // cabang
    public $cabang_id;
    public $cabangSelect;
    public function updatedCabangId(){
        $this->emit('cabangChanged', $this->cabang_id);
    }
    // sort
    public $shortField = 0;
    public $shortableField = [
        ['field' => 'created_at',    'short' => 'DESC',  'label'  => 'Terbaru ditambahkan'],
        ['field' => 'created_at',    'short' => 'ASC',  'label'  => 'Terakhir ditambahkan'],
        ['field' => 'name',          'short' => 'ASC',  'label'  => 'Nama Barang - Menaik'],
        ['field' => 'name',          'short' => 'DESC', 'label' => 'Nama Barang - Menurun'],
        ['field' => 'quantity_sum',  'short' => 'ASC',  'label'  => 'Jumlah Stok - Menaik'],
        ['field' => 'quantity_sum',  'short' => 'DESC', 'label'  => 'Jumlah Stok - Menurun'],

    ];

    public function openFillModal($id){
        $this->emit('openFillModal', $id);
    }
    public function openEditModal($id){
        $this->emit('openEditModal', $id);
    }
    public function openCreateModal(){
        $this->emit('openCreateModal');
    }
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
                with(['stocks' => function($query) use ($cabangId){
                    $query->where('cabang_id', $cabangId);
                    // $query->where('quantity', '>', 0);
                }])
                // ->whereHas('stocks', function($query) use ($cabangId){
                //     $query->where('cabang_id', $cabangId);
                // })
                ->withSum(['stocks as quantity_sum' => function ($query) use ($cabangId) {
                    $query->where('cabang_id', $cabangId);
                }], 'quantity');

        $items->where(function ($query) {
            $query->where('name', 'like', "%$this->searchQuery%")->orWhere('barcode', 'like', "%$this->searchQuery%");
        });
        // $items->where('has_expired', true);

        // ORDER
        $shortRule = $this->shortableField[$this->shortField];
        $items->orderBy($shortRule['field'], $shortRule['short']);
        $this->data_count = $items->count();
        return $items;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.gudang.manage.item-table', [
            'items' => $this->data->paginate($this->paginate_count)
        ]);
    }

}
