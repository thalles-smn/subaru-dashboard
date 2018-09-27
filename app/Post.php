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

    protected $dateFormat = 'd/m/Y H:i:s';

    public function toArray()
    {
        $array = parent::toArray();
        $array['photo'] = env('AWS_URL') . $this->photos()->first()->path;
        return $array;
    }

    public function photos(){
        return Photo::where("post_id", $this->id)->get();
    }
}
