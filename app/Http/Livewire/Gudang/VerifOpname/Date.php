<?php

namespace App\Http\Livewire\Gudang\VerifOpname;

use App\Models\Cabang;
use App\Models\StockOpname;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Date extends Component{
    public $user;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_item_table' => 'mount'];

    public $paginate_count = 10, $data_count;
    public $page = 1; // for page number
    // search

    public function mount(){
        $this->resetPage();
        $this->data = $this->getData();
        $this->cabangSelect =  Cabang::all();
    }
    public function updated(){
        $this->resetPage();
        $this->emit('cabang_change');
        $this->data = $this->getData();
    }

    // cabang
    public $cabang_id = 1;
    public $cabangSelect;

    // pagging
    protected $data;
    public function updatingPaginateCount() {
        $this->resetPage();
    }

    public function detail($date){
        $cabangId = $this->cabang_id;
        $this->emit('show_opnames_detail', $cabangId, $date);
    }
    public function getData(){
        $cabangId = $this->cabang_id;
        $opnames =
        StockOpname::
            whereHas('stockItem', function($query) use ($cabangId){
                $query->where('cabang_id', $cabangId);
            })
            ->select('date')
            ->selectRaw('COUNT(*) as item_checked')
            ->selectRaw('SUM(CASE WHEN is_acc = true THEN 1 ELSE 0 END) as is_acc_true')
            ->selectRaw('SUM(CASE WHEN is_acc = false THEN 1 ELSE 0 END) as is_acc_false')
            ->selectRaw('SUM(CASE WHEN is_acc = true THEN diff_price ELSE 0 END) as diff_price_total')
            ->groupBy('date')
            ->orderBy('date', 'desc');

        $this->data_count = $opnames->count();
        return $opnames;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.gudang.verif-opname.date', [
            'opnames' => $this->data->paginate($this->paginate_count)
        ]);
    }
}
