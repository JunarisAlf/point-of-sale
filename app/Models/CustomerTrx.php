<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTrx extends Model{
    use HasFactory;
    protected $table = 'customer_trxs';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function details(){
        return $this->hasMany(CustomerTrxDetail::class, 'cus_trx_id', 'id');
    }
    public function cabang(){
        return $this->belongsTo(Cabang::class, 'cabang_id', 'id');
    }
}
