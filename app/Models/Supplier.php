<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model{
    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    use HasFactory;

    public function buys(){
        return $this->hasMany(Buy::class, 'buy_id', 'id');
    }
}
