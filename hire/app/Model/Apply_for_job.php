<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apply_for_job extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	 protected $table='apply_for_jobs';
    //
}
