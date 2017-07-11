<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Employee_details extends Model
{
    //
    use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table='employee_details';
}
