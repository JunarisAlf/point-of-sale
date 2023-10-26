<?php

namespace App\Http\Livewire\Gudang\ReturList;

use App\Models\Buy;
use App\Models\Cabang;
use App\Models\Retur;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ReturListTable extends Component{
    public $user;
    public $type = 'ke-supplier';
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

    // pagging
    protected $data;
    public function updatingPaginateCount() {
        $this->resetPage();
    }
    public function getData(){
        $cabangId = $this->cabang_id;

        $returs = Retur::query();
        $returs
            ->with(['details'])
            ->where('cabang_id', $cabangId)
            ->where('type', $this->type);
        //date
        if(isset($this->dateRange['date']) ){
            $returs->whereDate('created_at', $this->dateRange['date']);
        }
        //daterange
        if(isset($this->dateRange['start']) && isset($this->dateRange['end']) ){
            $returs->whereBetween('created_at', [$this->dateRange['start'], $this->dateRange['end']]);
        }
        $returs->orderBy('id', 'DESC');
        $this->data_count = $returs->count();
        return $returs;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.gudang.retur-list.retur-list-table', [
            'returs' => $this->data->paginate($this->paginate_count)
        ]);
    }
}
