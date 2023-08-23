<?php

namespace App\Http\Livewire\Trx\DebtList;

use App\Models\Buy;
use App\Models\Cabang;
use Livewire\Component;
use Livewire\WithPagination;

class DebtListTable extends Component{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_debt_table' => 'mount'];

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

    // cabang
    public $cabang_id = 'all';
    public $cabangSelect;

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
            ->where('is_paid', false);

        if($this->cabang_id !== 'all' && $this->cabang_id !== null){
            $buys->where('cabang_id', $cabangId);
        }
        $buys->join('suppliers', 'buys.supplier_id', '=', 'suppliers.id');
        // ORDER
        $shortRule = $this->shortableField[$this->shortField];
        $buys->orderBy($shortRule['field'], $shortRule['short']);
        $this->data_count = $buys->count();
        return $buys;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.trx.debt-list.debt-list-table', [
            'buys' => $this->data->paginate($this->paginate_count)
        ]);
    }

}
