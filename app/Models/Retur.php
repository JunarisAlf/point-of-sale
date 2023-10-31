<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;
    protected $table = 'returs';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function details(){
        return $this->hasMany(ReturDetail::class, 'retur_id', 'id');
    }
    public function cabang(){
        return $this->belongsTo(Cabang::class, 'cabang_id', 'id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
