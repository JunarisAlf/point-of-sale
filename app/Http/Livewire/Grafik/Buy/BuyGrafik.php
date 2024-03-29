<?php

namespace App\Http\Livewire\Grafik\Buy;

use App\Models\Buy;
use App\Models\Cabang;
use App\Models\OnlineTrx;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BuyGrafik extends Component{
    protected $listeners = ['rangeChange'];
    public $date_start, $date_end;
    public $series, $xAxis;
    public $cabang_id = 'all', $cabangSelect;
    public function mount(){
        $this->date_start = Carbon::now()->startOfWeek()->subDay()->format('Y-m-d');
        $this->date_end = Carbon::now()->endOfWeek()->subDay()->format('Y-m-d');
        $this->cabangSelect = Cabang::all();
        $this->getData();
    }
    public function getData(){
        $cabang_id = $this->cabang_id;
        $buys = Buy::
            join('buy_details', 'buys.id', '=', 'buy_details.buy_id')
            ->select(DB::raw('DATE(buys.created_at) as date'), DB::raw('SUM(buy_details.grand_price) as total'))
            ->when($cabang_id != 'all' , function($query) use($cabang_id){
                $query->where('cabang_id', $cabang_id);
            })
            ->where('is_paid', true)
            ->whereBetween('buys.created_at', [$this->date_start, $this->date_end])->groupBy(DB::raw('DATE(buys.created_at)'))->get();
        $data = $buys->pluck('total')->toArray();
        $categories = $buys->pluck('date')->toArray();
        $this->series = [
            'name'  => 'Pembelian',
            'data'  => $data
        ];

        $this->xAxis = [
            'categories'    => $categories,
            'title'         => ['text'  => 'Tanggal']
        ];

    }
    public function updatedCabangId(){
        $this->getData();
        $this->dispatchBrowserEvent('refresh', ['series' => json_encode($this->series), 'xAxis' => json_encode($this->xAxis)]);
    }
    public function rangeChange($start, $end){
        $this->date_start = $start;
        $this->date_end = Carbon::parse($end)->addDay()->format('Y-m-d');
        $this->getData();
        $this->dispatchBrowserEvent('refresh', ['series' => json_encode($this->series), 'xAxis' => json_encode($this->xAxis)]);
    }
    public function render(){
        return view('livewire.grafik.buy.buy-grafik');
    }
}
