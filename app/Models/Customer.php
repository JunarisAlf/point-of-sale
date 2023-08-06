<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function trxs(){
        return $this->hasMany(CustomerTrx::class, 'customer_id', 'id');
    }

}
