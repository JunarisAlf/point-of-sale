<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model{
    use HasFactory;
    protected $table = 'cabangs';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function users(){
        return $this->hasMany(User::class, 'cabang_id', 'id');
    }
    public function barang(){
        return $this->belongsToMany(Item::class, 'cabang_items', 'cabang_id', 'item_id')
                    ->as('stocks')->withPivot('expired_date', 'quantity')->withTimestamps();
    }
    
}
