<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturDetail extends Model
{
    use HasFactory;
    protected $table = 'retur_details';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function retur(){
        return  $this->belongsTo(Retur::class, 'retur_id', 'id');
    }
    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
