<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = [
        'company_id',
        'deparment_id',
        'employee_name',
        'employee_img',
        'position',
        'costcenter',
        'lgaccount',
        'employee_phone',
        'remark'
    ];
}
