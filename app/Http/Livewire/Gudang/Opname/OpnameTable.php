<?php

namespace App\Http\Livewire\Gudang\Opname;

use App\Models\Cabang;
use App\Models\Category;
use App\Models\Item;
use App\Models\StockItem;
use Carbon\Carbon;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class OpnameTable extends Component{
    public $user;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_item_table' => 'refresh', 'categoryChange', 'dateChanged', 'cabangChange'];

    public $paginate_count = 10, $data_count;
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

    public function mount(){
        $this->resetPage();
        $this->data = $this->getData();
        $this->opname_date = Carbon::now()->format('Y-m-d');
        $this->cabang_id = $this->user->role === 'master' ? null : $this->user->cabang->id;
        // dd($this->data->get());
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
    public function cabangChange($id){
        $this->cabang_id = $id;
    }

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

    public $opname_date;
    public function dateChanged($date){
        $this->opname_date = $date;
    }

    public function markAsCorrect($id){
        $user = auth()->user();
        try{
            $stockItem = StockItem::find($id);
            $stockItem->opnames()->create([
                'date'      => $this->opname_date,
                'user_id'   => $user->id,
                'old_quantity'  => $stockItem->quantity,
                'quantity'  => $stockItem->quantity,
                'diff_price'=>  0
            ]);
            $this->emit('refresh_item_table');
            $this->emit('showSuccessAlert', 'Aksi Berhasil Dilakukan!');
        }catch(Exception $e){
            // dd($e);
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }

    public function makeCorrection($id){
        $this->emit('openEditModal', $id, $this->opname_date);
    }
    public function getData(){
        $items = Item::query();
        $cabangId = $this->cabang_id;
        $opname_date = Carbon::parse($this->opname_date)->format('Y-m-d');

        $items =
        Item::
            whereHas('stocks', function($query) use ($cabangId, $opname_date){
                $query->where('cabang_id', $cabangId);
                // $query->where('quantity', '>', 0);
                $query->whereDoesntHave('opnames', function($subQuery) use ( $opname_date){
                    $subQuery->where('date', $opname_date);
                });
            })
            ->with(['stocks' => function($query) use ($cabangId, $opname_date){
                $query->where('cabang_id', $cabangId);
                // $query->where('quantity', '>', 0);
                $query->whereDoesntHave('opnames', function($subQuery) use ( $opname_date){
                    $subQuery->where('date', $opname_date);
                });
            }])
            ->withSum(['stocks as quantity_sum' => function ($query) use ($cabangId) {
                $query->where('cabang_id', $cabangId);
            }], 'quantity');

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
        return view('livewire.gudang.opname.opname-table', [
            'items' => $this->data->paginate($this->paginate_count)
        ]);
    }
}
