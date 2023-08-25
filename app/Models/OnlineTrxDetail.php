<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineTrxDetail extends Model{
    use HasFactory;
    protected $table = 'online_trx_details';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function trx(){
        return  $this->belongsTo(OnlineTrx::class, 'online_trx_id', 'id');
    }
    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
    public function satuan(){
        return $this->belongsTo(QtyConverter::class, 'satuan_id', 'id');
    }
}
