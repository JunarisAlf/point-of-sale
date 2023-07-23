<?php

namespace App\Http\Livewire\Gudang\VerifOpname;

use App\Models\Cabang;
use App\Models\Category;
use App\Models\Item;
use App\Models\StockOpname;
use Carbon\Carbon;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Detail extends Component{
    use WithPagination;
    public $show = false;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_item_table' => 'mount', 'show_opnames_detail' => 'showDetail'];

    public $paginate_count = 20, $data_count;
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
        // $this->opname_date = Carbon::now()->format('Y-m-d');
        // dd($this->data->get());
    }
    public function updated(){
        $this->resetPage();
        $this->data = $this->getData();
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
    public $cabang_id;
    public function showDetail($cabang_id, $date){
        $this->cabang_id = $cabang_id;
        $this->opname_date = $date;
        $this->show = true;
    }

    public $checks = [];
    public function toggle($id){
        $index = array_search($id, $this->checks);
        if ($index !== false) {
            unset($this->checks[$index]);
        }else {
            array_push($this->checks, $id);
        }
    }
    public $checked = false;
    public function toggleAll(){
        $datas = $this->getData()->get();
        if($this->checked == true){
            $this->checks = [];
            $this->checked = false;
        }else{
            foreach ($datas as $data) {
                foreach ($data->stocks as $stocks) {
                    foreach ($stocks->opnames as $opname) {
                        array_push($this->checks, $opname->id);
                    }
                }
            }
            $this->checked = true;

        }
    }
    public function accChecked(){
        try{
            StockOpname::whereIn('id', $this->checks)->update(['is_acc' => true]);
            $this->checks = [];
            $this->emit('showSuccessAlert', 'Aksi Berhasil!');
            $this->emit('refresh_item_table');
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function accOpname($id){
        try{
            $opname = StockOpname::find($id);
            $opname->is_acc = true;
            $opname->stockItem->quantity = $opname->quantity;
            $opname->stockItem->save(); 
            $opname->save();
            $this->emit('showSuccessAlert', 'Aksi Berhasil!');
            $this->emit('refresh_item_table');

        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function getData(){
        $items = Item::query();
        $cabangId = $this->cabang_id;
        $opname_date = $this->opname_date;

        $items = 
        Item::
            whereHas('stocks', function($query) use ($cabangId, $opname_date){
                $query->where('cabang_id', $cabangId);
                $query->whereHas('opnames', function($subQuery) use ( $opname_date){
                    $subQuery->where('date', $opname_date);
                });
            })
            ->with(
                ['stocks' => function($query) use ($cabangId, $opname_date){
                    $query->where('cabang_id', $cabangId);
                    $query->where('quantity', '>', 0);
                    $query->whereHas('opnames', function($subQuery) use ( $opname_date){
                        $subQuery->where('date', $opname_date);
                    });
                },
                'stocks.opnames' => function($query) use ( $opname_date){
                    $query->where('date', $opname_date);
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
        return view('livewire.gudang.verif-opname.detail', [
            'items' => $this->data->paginate($this->paginate_count)
        ]);
    }
}
