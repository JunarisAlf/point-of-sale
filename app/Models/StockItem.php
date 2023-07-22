<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockItem extends Model{
    use HasFactory;
    protected $table = 'cabang_items';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $guarded = ['id'];
    
    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
    public function opnames(){
        return $this->hasMany(StockOpname::class, 'stock_item_id', 'id');
    }
    public function opname(){
        return $this->opnames()->one()->ofMany();
    }
    
}
