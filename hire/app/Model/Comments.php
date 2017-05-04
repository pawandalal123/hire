<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    //
    use SoftDeletes;

	 protected $dates = ['deleted_at'];
	 protected $table='comments';
}
