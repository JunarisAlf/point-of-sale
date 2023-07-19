<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model{
    use HasFactory;
    protected $table = 'cabang_items';
    protected $primaryKey = ['cabang_id', 'item_id', 'expired_date'];
    public $incrementing = false;

    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
