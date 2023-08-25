<?php

namespace App\Http\Livewire\Trx\SellEntryOnline;

use App\Models\CustomerTrx;
use App\Models\OnlineTrx;
use App\Models\StockItem;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ConfirmModal extends Component {
    public $show = false, $items;
    public $grand_total;
    protected $listeners = ['openConfirmModal' => 'openModal'];

    public function openModal($data){
        $this->items = $data['items'];
        $this->grand_total = $data['metainfo']['totalSum'];
        $this->show = true;
    }

    public function store(){
        $cabang_id = Auth::user()->role == 'master' ? session('cabang_id') : Auth::user()->cabang->id;
        $online_trx = [
            'cabang_id'         => $cabang_id,
            'user_id'           => Auth::user()->id,
            'note'              => session()->get('note', '-'),
            'date'              => Carbon::now()->format('Y-m-d H:i:s'),
            'total'             => $this->grand_total ,
        ];
        $trx_details = [];
        foreach ($this->items as $key => $item) {
            array_push($trx_details, [
                'item_id'       => $item['id'],
                'satuan_id'     => $item['satuan_id'],
                'qty_satuan'    => $item['converted_qty'],
                'quantity'      => $item['quantity'],
                'price'         => $item['price'],
                'grand_price'   => $item['total_price']
            ]);
        }
        DB::beginTransaction();
        try {
            $trx_elequent = OnlineTrx::create($online_trx);
            $trx_elequent->details()->createMany($trx_details);
            foreach ($trx_details as $key => $detail) {
                $stocks = StockItem::where('item_id', $detail['item_id'])->where('cabang_id', $cabang_id)->where('quantity', '>', 0)->orderBy('expired_date', 'ASC')->get();
                $qtyOut = $detail['qty_satuan'];
                $stocks->each(function ($value, $key) use ($stocks, &$qtyOut) {
                    if($value->quantity >= $qtyOut){
                        $value->quantity -= $qtyOut;
                        $value->save();
                        return false;
                    }else{
                        //check if current iteration is the last or not
                        if ($key === $stocks->keys()->last()) {
                            $value->quantity -= $qtyOut;
                            $value->save();
                            // echo "Last iteration: $value\n";
                        }else {
                            $qtyOut -= $value->quantity;
                            $value->quantity = 0;
                            $value->save();
                            // echo "Not the last iteration: $value\n";
                        }
                    }
                });
            }

            DB::commit();
            $this->emit('refreshPage');
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
        } catch (Exception $e) {
            DB::rollBack();
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render() {
        return view('livewire.trx.sell-entry-online.confirm-modal');
    }
}
