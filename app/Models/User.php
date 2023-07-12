<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\TimeStampGetter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable{
    use TimeStampGetter;
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded = ['id'];
    protected $hidden = [ 'password'];

    public function cabang(){
        return $this->belongsTo(Cabang::class, 'cabang_id', 'id');
    }
    public function accountAge(){
        $date = Carbon::createFromFormat('d-m-Y H:i:s', $this->created_at)->diffForHumans();
        return $date;
    }
    protected function password(): Attribute{
        return Attribute::make(
            set: function(?String $password){
                if($password !== null){
                    return Hash::make($password);
                }
                return $this->password;
            }
        );
    }
}
