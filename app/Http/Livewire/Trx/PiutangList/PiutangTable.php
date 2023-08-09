<?php

namespace App\Http\Livewire\Trx\PiutangList;

use App\Models\Cabang;
use App\Models\CustomerTrx;
use Livewire\Component;
use Livewire\WithPagination;

class PiutangTable extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_piutang_table' => 'mount'];
    
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
    public function updated(){
        $this->resetPage();
        $this->data = $this->getData();
    }
    // hutang status
    public $piutang_status = 'unpaid';
    // cabang
    public $cabang_id = 'all';
    public $cabangSelect;
    
    // sort
    public $shortField = 4;
    public $shortableField = [
        ['field' => 'customers.name',       'short' => 'ASC',   'label'     => 'Nama Pelanggan - Menaik'],
        ['field' => 'customers.name',       'short' => 'DESC',  'label'     => 'Nama Pelanggan - Menurun'],
        ['field' => 'total',                'short' => 'ASC',   'label'     => 'Total Bayar - Menaik'],
        ['field' => 'total',                'short' => 'DESC',  'label'     => 'Total Bayar - Menurun'],
        ['field' => 'date',                 'short' => 'DESC',  'label'     => 'Tanggal Pembelian - Terbaru'],
        ['field' => 'date',                 'short' => 'ASC',   'label'     => 'Tanggal Pembelian - Terlama'],
    ];
    
    public function openDetailModal($id){
        $this->emit('openDetailModal', $id);
    }
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
            ->with(['details'])
            ->withSum('details as discount', 'discount')
            ->whereHas('customer', function($query) use ($keyword){
                $query->where('name', 'like', "%$keyword%");
        });
           
        if($this->piutang_status == 'unpaid'){
            // is_paid: false, paid_date: null is debt
            $sells->where('is_paid', false)->where('paid_date', null) ;
        }else if($this->piutang_status == 'paid'){
            // is_paid: true, paid_date: date is payed debt
            $sells->where('is_paid', true)->where('paid_date', '!=', null) ;
        }
        //cabang
        if($this->cabang_id !== null && $this->cabang_id !== 'all'){
            $sells->where('cabang_id', $cabangId);
        }
        // daterange
        if(isset($this->dateRange['start']) && isset($this->dateRange['end']) ){
            $sells->whereBetween('date', [$this->dateRange['start'], $this->dateRange['end']]);
        }

        $sells->join('customers', 'customer_trxs.customer_id', '=', 'customers.id');
        // ORDER
        $shortRule = $this->shortableField[$this->shortField];
        $sells->orderBy($shortRule['field'], $shortRule['short']);
        $this->data_count = $sells->count();
        return $sells;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.trx.piutang-list.piutang-table', [
            'sells' => $this->data->paginate($this->paginate_count)
        ]);
    }
   
}
