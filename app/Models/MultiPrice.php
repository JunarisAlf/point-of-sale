<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiPrice extends Model{
    use HasFactory;
    protected $table = 'multi_prices';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
