<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model{
    use HasFactory;
    protected $table = 'stock_opnames';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function stockItem(){
        return $this->belongsTo(StockItem::class, 'stock_item_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
