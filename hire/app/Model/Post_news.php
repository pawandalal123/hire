<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post_news extends Model
{
    //
     use SoftDeletes;

	 protected $dates = ['deleted_at'];
	 protected $table='post_news';
}
