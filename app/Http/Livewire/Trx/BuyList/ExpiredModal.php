<?php

namespace App\Http\Livewire\Trx\BuyList;

use App\Models\Buy;
use App\Models\StockItem;
use Exception;
use Livewire\Component;

class ExpiredModal extends Component {
    public $show = false;
    public $details = [];
    public $data_id, $date, $expired_dates = [];
    protected $listeners = ['openExpiredModal' => 'openModal'];
    public function openModal($id){
        $this->data_id = $id;
        $buy = Buy::with('details')->find($id);
        $this->details = $buy->details;
        foreach ($this->details as $key => $detail) {
            if($detail->item->has_expired){
                $this->expired_dates[$detail->item_id] = ['expired_date' => null];
            }
        }
        $this->show = true;
        // dd($this->expired_dates);
    }

    public function dateInputed($item_id, $value){
        // $index = array_search($item_id, array_column($this->expired_dates, 'item_id'));
        $this->expired_dates[$item_id] = ['expired_date' => $value];

        // if($index !== false){
        //     $this->expired_dates[$index] = ['item_id' => $item_id, 'expired_date' => $value];
        // }else{
        //     array_push($this->expired_dates, ['item_id' => $item_id, 'expired_date' => $value]);
        // }
        // dd($this->expired_dates);
    }

    public function rules(){
        return [
            'expired_dates'                     => 'array' ,
            'expired_dates.*.expired_date'      => 'required'
        ];
    }
    public function messages() {
        return [
            'expired_dates.*.expired_date.required' => 'Expired Date Tidak Boleh Kosong',
        ];
    }
    public function submit($id){
        $this->validate();
        try{
            foreach ($this->details as $key => $detail) {
                $oldQtySum = $detail->item->barang()->where('cabang_id', $detail->buy->cabang_id)->sum('quantity');
                $oldPrice = $detail->item->barang()->where('cabang_id', $detail->buy->cabang_id)->avg('buying_price') ?? 0;
                $oldModalSum = $oldQtySum * $oldPrice;
                $addedModalSum = $detail->grand_price;
                $newPrice = ($oldModalSum + $addedModalSum) / ($oldQtySum + $detail->qty_satuan);

                $has_expired = $detail->item->has_expired;
                if($has_expired){
                    // $index = array_search($detail->item_id, array_column($this->expired_dates, 'item_id'));
                    $expired_date = $this->expired_dates[$detail->item_id]['expired_date'];
                    $stockItem = StockItem::
                        where('item_id', $detail->item_id)->where('cabang_id', $detail->buy->cabang_id)
                        ->where('expired_date', $expired_date)->first();

                    //if null make new one
                    if($stockItem == null){
                        $detail->item->barang()->attach($detail->buy->cabang_id, [
                            'expired_date' => $expired_date,
                            'buying_price' => $newPrice,
                            'quantity' => $detail->qty_satuan
                        ]);
                    }else{
                        //else update exists
                        $stockItem->quantity += $detail->qty_satuan;
                        $stockItem->buying_price = $newPrice;
                        $stockItem->save();
                    }
                    //update price for same item with different expired date
                    $detail->item->barang()->where('cabang_id', $detail->buy->cabang_id)->update(['buying_price' => $newPrice]);
                }else{
                    $stockItem =StockItem::where('item_id', $detail->item_id)->where('cabang_id', $detail->buy->cabang_id)->where('expired_date', null)->first();
                    $stockItem->quantity += $detail->qty_satuan;
                    $stockItem->buying_price = $newPrice;
                    $stockItem->save();
                }
            }
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data!');
            $buy = Buy::find($id);
            $buy->is_arrived = true;
            $buy->save();
            $this->emit('refresh_buy_table');
            $this->show = false;
        }catch(Exception $e){
            $this->emit('showDangerAlert', 'Server ERROR!');
        }


    }
    public function render() {
        return view('livewire.trx.buy-list.expired-modal');
    }
}
