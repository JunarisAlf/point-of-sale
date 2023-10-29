<?php

namespace App\Http\Livewire\Trx\SellEntryRev;

use App\Models\Cash;
use App\Models\Customer;
use App\Models\CustomerTrx;
use App\Models\StockItem;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ConfirmModal extends Component {
    public $show = false, $items;
    public $is_paid = true, $customer_id;
    public $pay = 0, $change, $globalDisc = 0, $sub_total, $grand_total, $discount;
    protected $listeners = ['openConfirmModal' => 'openModal', 'payChange', 'globalDiscChange'];

    public function openModal($data){
        $this->items = $data['items'];
        $this->sub_total = $data['metainfo']['subTotal'];
        $this->grand_total = $data['metainfo']['totalSum'];
        $this->discount = $data['metainfo']['totalDisc'];
        $this->customer_id = $data['metainfo']['customer_id'];
        $this->show = true;
    }
    public function payChange($val){
        $this->pay = intval($val);
        $this->change = $this->pay - ($this->grand_total - $this->globalDisc) ;
    }
    public function globalDiscChange($val){
        $this->globalDisc = intval($val);
        $this->change = $this->pay - ($this->grand_total - $this->globalDisc) ;
    }
    public function store(){
        // $cabang_id = Auth::user()->cabang?->id == null ? 1 : Auth::user()->cabang->id;
        $cabang_id = Auth::user()->cabang->id;
        $customer_trx = [
            'customer_id'       => $this->customer_id,
            'cabang_id'         => $cabang_id,
            'user_id'           => Auth::user()->id,
            'date'              => Carbon::now()->format('Y-m-d H:i:s'),
            'paid_date'         => null,
            'is_paid'           => $this->is_paid,
            'total_pay'         => $this->pay,
            'sub_total'         => $this->sub_total,
            'total_discount'    => $this->discount + $this->globalDisc,
            'total'             => $this->grand_total - $this->globalDisc,
        ];
        $trx_details = [];
        foreach ($this->items as $key => $item) {
            array_push($trx_details, [
                'item_id'       => $item['id'],
                'quantity'      => $item['quantity'],
                'satuan_id'     => $item['satuan_id'],
                'qty_satuan'    => $item['converted_qty'], // real qty
                'price'         => $item['price'],
                'discount'      => $item['discount'],
                'grand_price'   => $item['total_price']
            ]);
        }
        DB::beginTransaction();
        try {
            $trx_elequent = CustomerTrx::create($customer_trx);
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
            if($this->is_paid){
                Cash::create([
                    'cabang_id'     => $cabang_id,
                    'date'          => Carbon::now()->format('Y-m-d H:i:s'),
                    'flow'          => 'in',
                    'total'         => $customer_trx['total'],
                    'name'          => "Penjualan AN. " . @Customer::find(@$customer_trx['customer_id'])->name
                ]);
            }
            session()->forget('entry-item');
            session()->forget('metainfo');
            DB::commit();
            $this->emit('refreshPage', route('receipt', ['id' => $trx_elequent->id ]));
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
        } catch (Exception $e) {
            DB::rollBack();
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render() {
        return view('livewire.trx.sell-entry-rev.confirm-modal');
    }
}
