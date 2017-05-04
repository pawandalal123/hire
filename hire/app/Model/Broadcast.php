<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Broadcast extends Model
{
    //
    use SoftDeletes;

	 protected $dates = ['deleted_at'];
	 protected $table='broadcasts';
}
