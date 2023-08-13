<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineTrx extends Model{
    use HasFactory;
    protected $table = 'online_trxs';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function details(){
        return $this->hasMany(OnlineTrxDetail::class, 'online_trx_id', 'id');
    }
    public function cabang(){
        return $this->belongsTo(Cabang::class, 'cabang_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
