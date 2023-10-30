<?php

namespace App\Http\Livewire\Cash\Setoran;

use App\Models\Cabang;
use App\Models\CustomerTrx;
use App\Models\Deposit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SetoranTable extends Component{
    public $user;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh_setoran_table' => 'mount', 'dateRangeChange'];

    public $paginate_count = 50, $data_count;
    public $page = 1; // for page number

    public $dateRange;
    public function mount(){
        $this->resetPage();
        $this->data = $this->getData();
        $this->cabangSelect =  Cabang::all();
        $this->dateRange['date'] =  Carbon::now();
    }
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
    public $cabang_id = 'all';
    public $cabangSelect;

    // pagging
    protected $data;
    public function updatingPaginateCount() {
        $this->resetPage();
    }
    public function getData(){
        $cabangId = $this->cabang_id;

        $setorans = Deposit::query();
        //cabang
        if($this->cabang_id !== null && $this->cabang_id !== 'all'){
            $setorans->where('cabang_id', $cabangId);
        }
        //date
        if(isset($this->dateRange['date']) ){
            $setorans->whereDate(DB::raw('DATE(created_at)'), $this->dateRange['date']);
        }
        //daterange
        if(isset($this->dateRange['start']) && isset($this->dateRange['end']) ){
            $setorans->whereBetween(DB::raw('DATE(created_at)'), [$this->dateRange['start'], $this->dateRange['end']]);
        }
        $this->data_count = $setorans->count();
        return $setorans;
    }
    public function render(){
        $this->data = $this->getData();
        return view('livewire.cash.setoran.setoran-table', [
            'setorans' => $this->data->paginate($this->paginate_count)
        ]);
    }

}
