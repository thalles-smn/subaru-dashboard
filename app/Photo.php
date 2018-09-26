<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Photo extends Model
{
    protected $collection = "photos";
    protected $fillable = [
      'post_id',
      'path'
    ];
}
