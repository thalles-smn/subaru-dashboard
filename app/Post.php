<?php

namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    protected $collection = "posts";
    protected $fillable = [
        "title",
        "text",
        "author",
        "youtube_url",
        "active"
    ];

    public function photos(){
        return Photo::where("post_id", $this->id)->get();
    }
}
