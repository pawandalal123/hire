<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_followers extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	 protected $table='user_followers';
    //
}
