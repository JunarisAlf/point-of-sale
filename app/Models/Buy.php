<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model{
    protected $table = 'buys';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    use HasFactory;
    public function details(){
        return $this->hasMany(BuyDetail::class, 'buy_id', 'id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    public function cabang(){
        return $this->belongsTo(Cabang::class, 'cabang_id', 'id');
    }
}
