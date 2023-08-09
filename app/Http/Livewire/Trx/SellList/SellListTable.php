<?php

namespace App\Http\Livewire\Trx\SellList;

use App\Models\Cabang;
use App\Models\CustomerTrx;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class SellListTable extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_sell_table' => 'mount', 'dateRangeChange'];
    
    public $paginate_count = 50, $data_count;
    public $page = 1; // for page number
    // search
    public $searchQuery;
   
    public function mount(){
        $this->resetPage();
        $this->data = $this->getData();
        $this->cabangSelect =  Cabang::all();
        $this->cabang_id = $this->cabangSelect->first()->id;
        // dd($this->data->get());
    }
    public $dateRange;
    public function dateRangeChange($range){
        $range = explode(" to ", $range);
        $this->dateRange = [
            'start'     => isset($range[0])  ? Carbon::createFromFormat('d-m-Y', $range[0])->format('Y-m-d') : Carbon::now()->format('Y-m-d'),
            'end'       => isset($range[1])  ? Carbon::createFromFormat('d-m-Y', $range[1])->format('Y-m-d') : Carbon::now()->format('Y-m-d')
        ];
        $this->updated();
    }
    
    public function updated(){
        $this->resetPage();
        $this->data = $this->getData();
    }
    public function openDetailModal($id){
        $this->emit('openDetailModal', $id);
    }
    // cabang
    public $cabang_id;
    public $cabangSelect;
    
    // sort
    public $shortField = 4;
    public $shortableField = [
        ['field' => 'customers.name',       'short' => 'ASC',   'label'     => 'Nama Customer - Menaik'],
        ['field' => 'customers.name',       'short' => 'DESC',  'label'     => 'Nama Customer - Menurun'],
        ['field' => 'total',               'short' => 'ASC',   'label'     => 'Total Bayar - Menaik'],
        ['field' => 'total',               'short' => 'DESC',  'label'     => 'Total Bayar - Menurun'],
        ['field' => 'date',                 'short' => 'DESC',  'label'     => 'Tanggal Pembelian - Terbaru'],
        ['field' => 'date',                 'short' => 'ASC',   'label'     => 'Tanggal Pembelian - Terlama'],
    ];
 
    // pagging
    protected $data;
    public function updatingPaginateCount() {
        $this->resetPage();
    }
    public function getData(){
        $cabangId = $this->cabang_id;
        $keyword = $this->searchQuery;

        $sells = CustomerTrx::query();
        $sells
            ->with(['details'])->withSum('details as discount', 'discount')
            ->whereHas('customer', function($query) use ($keyword){
                $query->where('name', 'like', "%$keyword%");
            })
            ->where('cabang_id', $cabangId)
            ->join('customers', 'customer_trxs.customer_id', '=', 'customers.id');
        //daterange
        if(isset($this->dateRange['start']) && isset($this->dateRange['end']) ){
            $sells->whereBetween('date', [$this->dateRange['start'], $this->dateRange['end']]);
        }
        // ORDER
        $shortRule = $this->shortableField[$this->shortField];
        $sells->orderBy($shortRule['field'], $shortRule['short']);
        $this->data_count = $sells->count();
        return $sells;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.trx.sell-list.sell-list-table', [
            'sells' => $this->data->paginate($this->paginate_count)
        ]);
    }
 
}
