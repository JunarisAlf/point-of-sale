<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model{
    use HasFactory;
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function barang(){
        return $this->belongsToMany(Cabang::class, 'cabang_items', 'item_id', 'cabang_id')
                    ->as('stocks')->withPivot('expired_date', 'quantity')->withTimestamps();
    }

    public function stocks(){
        return $this->hasMany(StockItem::class, 'item_id', 'id');
    }

    public function prices(){
        return $this->hasMany(MultiPrice::class, 'item_id', 'id');
    }
  
}

