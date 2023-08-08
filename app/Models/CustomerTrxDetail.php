<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTrxDetail extends Model{
    use HasFactory;
    protected $table = 'customer_trx_details';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function trx(){
        return  $this->belongsTo(CustomerTrx::class, 'cus_trx_id', 'id');
    }
    public function item(){
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
