<?php

namespace App\Http\Livewire\Trx\BuyList;

use App\Models\Buy;
use App\Models\Cabang;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class BuyListTable extends Component{
    public $user;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_buy_table' => 'mount', 'dateRangeChange'];


    public $paginate_count = 50, $data_count;
    public $page = 1; // for page number
    // search
    public $searchQuery;

    public function mount(){
        $this->resetPage();
        $this->data = $this->getData();
        $this->cabangSelect =  Cabang::all();

        // dd($this->data->get());
    }

    public $dateRange;
    public function dateRangeChange($range){
        $range = explode(" to ", $range);
        if(count($range) === 2){
            $this->dateRange = [
                'start'     => isset($range[0])  ? Carbon::createFromFormat('d-m-Y', $range[0])->format('Y-m-d') : Carbon::now()->format('Y-m-d'),
                'end'       => isset($range[1])  ? Carbon::createFromFormat('d-m-Y', $range[1])->format('Y-m-d') : Carbon::now()->format('Y-m-d')
            ];
        }else if(count($range) === 1){
            $this->dateRange = [
                'date'     => Carbon::createFromFormat('d-m-Y', $range[0])->format('Y-m-d')
            ];
        }
        $this->updated();
    }

    public function updated(){
        $this->resetPage();
        $this->data = $this->getData();
    }

    // cabang
    public $cabang_id = 1;
    public $cabangSelect;

    public $is_arrived = 'all';
    public $is_paid = 'all';

    // sort
    public $shortField = 4;
    public $shortableField = [
        ['field' => 'suppliers.name',    'short' => 'ASC',   'label'     => 'Nama Supplier - Menaik'],
        ['field' => 'suppliers.name',    'short' => 'DESC',  'label'     => 'Nama Supplier - Menurun'],
        ['field' => 'price_sum',        'short' => 'ASC',   'label'  => 'Harga - Menaik'],
        ['field' => 'price_sum',        'short' => 'DESC',  'label'  => 'Harga - Menurun'],
        ['field' => 'created_at',             'short' => 'DESC',  'label'  => 'Tanggal Pembelian - Terbaru'],
        ['field' => 'created_at',             'short' => 'ASC',   'label'  => 'Tanggal Pembelian - Terlama'],
    ];


    // pagging
    protected $data;
    public function updatingPaginateCount() {
        $this->resetPage();
    }
    public function getData(){
        $cabangId = $this->cabang_id;
        $keyword = $this->searchQuery;

        $buys = Buy::query();
        $buys
            ->with(['details'])->withSum('details as price_sum', 'grand_price')
            ->whereHas('supplier', function($query) use ($keyword){
                $query->where('name', 'like', "%$keyword%");
            })
            ->where('cabang_id', $cabangId)
            ->join('suppliers', 'buys.supplier_id', '=', 'suppliers.id');

        //date
        if(isset($this->dateRange['date']) ){
            $buys->whereDate('buys.created_at', $this->dateRange['date']);
        }
        //daterange
        if(isset($this->dateRange['start']) && isset($this->dateRange['end']) ){
            $buys->whereBetween('buys.created_at', [$this->dateRange['start'], $this->dateRange['end']]);
        }
        // Is Paid
        if($this->is_paid !== 'all'){
            $buys->where('is_paid', $this->is_paid);
        }

        // Is Arrived
        if($this->is_arrived !== 'all'){
            $buys->where('is_arrived', $this->is_arrived);
        }
        // ORDER
        $shortRule = $this->shortableField[$this->shortField];
        $buys->orderBy($shortRule['field'], $shortRule['short']);
        $this->data_count = $buys->count();
        return $buys;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.trx.buy-list.buy-list-table', [
            'buys' => $this->data->paginate($this->paginate_count)
        ]);
    }
}
