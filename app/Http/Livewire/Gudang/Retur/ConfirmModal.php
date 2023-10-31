<?php

namespace App\Http\Livewire\Gudang\Retur;

use App\Models\Cabang;
use App\Models\CustomerTrx;
use App\Models\Item;
use App\Models\OnlineTrx;
use App\Models\Retur;
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
        $this->show = true;
    }

    public function store(){
        $cabang_id = Auth::user()->role == 'master' ? session('cabang_id') : Auth::user()->cabang->id;
        $retur_details = [];
        foreach($this->items as $item){
            array_push($retur_details, [
                'item_id'   => $item['id'],
                'quantity'  => $item['converted_qty'],
                'harga'     => $item['harga'],
                'harga_total' => $item['harga_total']
            ]);
        }
        DB::beginTransaction();
        try {
            $type = session()->get('type');
            if($type == 'ke-supplier'){
                $retur = Retur::create([
                    'cabang_id'     => $cabang_id,
                    'type'          => $type,
                    'note'          => session()->get('note'),
                    'supplier_id'   => session()->get('supplier_id'),
                    'customer_id'   => null
                ]);
                foreach ($retur_details as  $detail) {
                    $retur->details()->create($detail);
                    $item_stocks = Item::find($detail['item_id'])->stocks()->where('cabang_id', $cabang_id)->get();
                    $retur_stock = $detail['quantity'];
                    // Kurangi stok di database
                    foreach($item_stocks as $stock){
                        if($stock->quantity >= $retur_stock){
                            $stock->quantity -=  $retur_stock;
                            $stock->save();
                            break;
                        }else{
                            $retur_stock -= $stock->quantity;
                            $stock->quantity = 0;
                            $stock->save();
                        }
                    }
                }
            } elseif($type == 'dari-customer'){
                $retur = Retur::create([
                    'cabang_id'     => $cabang_id,
                    'type'          => $type,
                    'note'          => session()->get('note'),
                    'supplier_id'   => null,
                    'customer_id'   => session()->get('customer_id')
                ]);
                foreach ($retur_details as  $detail) {
                    $retur->details()->create($detail);
                    $item_stocks = Item::find($detail['item_id'])->stocks()->where('cabang_id', $cabang_id)->first();
                    // Tambah stok di database
                    $item_stocks->quantity += intval($detail['quantity']);
                    $item_stocks->save();
                }
            }
            DB::commit();
            session()->forget('supplier_id', 'customer_id', 'note');
            $this->emit('refreshPage');
            $this->emit('showSuccessAlert', 'Berhasil Menambahkan Data Retur!');
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
            $this->emit('showDangerAlert', 'Server ERROR!');
        }
    }
    public function render() {
        return view('livewire.gudang.retur.confirm-modal');
    }
}
