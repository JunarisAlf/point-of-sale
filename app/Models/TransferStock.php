<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferStock extends Model
{
    use HasFactory;
    protected $table = 'transfer_stocks';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
    public function fromCabang(){
        return $this->belongsTo(Cabang::class, 'from_cabang_id', 'id');
    }
    public function toCabang(){
        return $this->belongsTo(Cabang::class, 'to_cabang_id', 'id');
    }
    public function stock(){
        return $this->belongsTo(StockItem::class, 'stock_id', 'id');
    }
}
