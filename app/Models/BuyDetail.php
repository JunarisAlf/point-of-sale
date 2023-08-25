<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyDetail extends Model{
    protected $table = 'buy_details';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    use HasFactory;
    public function buy(){
        return $this->belongsTo(Buy::class, 'buy_id', 'id');
    }
    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
    public function satuan(){
        return $this->belongsTo(QtyConverter::class, 'satuan_id', 'id');
    }
}
