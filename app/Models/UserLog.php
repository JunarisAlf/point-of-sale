<?php

namespace App\Models;

use App\Traits\TimeStampGetter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model{
    use HasFactory;
    use TimeStampGetter;
    protected $table = 'user_logs';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
