<?php

namespace App\Http\Livewire\Grafik\MostSell;

use App\Models\Cabang;
use App\Models\CustomerTrx;
use App\Models\CustomerTrxDetail;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MostSellGrafik extends Component{
    protected $listeners = ['rangeChange'];
    public $date_start, $date_end;
    public $items, $sellCount;
    public $cabang_id = 'all', $cabangSelect;
    public function mount(){
        $this->date_start = Carbon::now()->startOfWeek()->subDay()->format('Y-m-d');
        $this->date_end = Carbon::now()->endOfWeek()->subDay()->format('Y-m-d');
        $this->cabangSelect = Cabang::all();
        $this->getData();
    }
    public function getData(){
        $cabang_id = $this->cabang_id;
        $sells =
            CustomerTrx::
            when($cabang_id != 'all' , function($query) use($cabang_id){
                $query->where('cabang_id', $cabang_id);
            })
            ->where('is_paid', true)
            ->whereBetween('date', [$this->date_start, $this->date_end])
            ->with('details')
            ->get();
        $details = $sells->pluck('details')->flatten();
        $details = $details->groupBy('item_id')->map(function ($group) {
            return [
                'item' => Item::find($group->first()->item_id)->name,
                'sellCount' => $group->sum('qty_satuan'),
            ];
        });

        $this->items = $details->pluck('item')->toArray();
        $this->sellCount = $details->pluck('sellCount')->toArray();
    }
    public function updatedCabangId(){
        $this->getData();
        $this->dispatchBrowserEvent('refresh', ['items' => json_encode($this->items), 'sellCount' => json_encode($this->sellCount)]);
    }
    public function rangeChange($start, $end){
        $this->date_start = $start;
        $this->date_end = Carbon::parse($end)->addDay()->format('Y-m-d');
        $this->getData();
        $this->dispatchBrowserEvent('refresh', ['items' => json_encode($this->items), 'sellCount' => json_encode($this->sellCount)]);
    }
    public function render(){
        return view('livewire.grafik.most-sell.most-sell-grafik');
    }
}
