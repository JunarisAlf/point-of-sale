<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QtyConverter extends Model{
    use HasFactory;
    protected $table = 'item_qty_converters';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $guarded = ['id'];

}
