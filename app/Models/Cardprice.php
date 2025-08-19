<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cardprice extends Model
{
    //
    protected $fillable = [
        'cardtype_id',
        'price'
    ];
}
