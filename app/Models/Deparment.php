<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deparment extends Model
{
    //
    protected $fillable = [
        'company_id',
        'name_deparment',
        'remark'
    ];
}
