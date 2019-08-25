<?php

namespace App;

use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Illuminate\Database\Eloquent\Model;

class PostQuestion extends Model
{
    use CanBeLiked;

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'postsquestions_tags', 'postquestion_id', 'tags_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment', 'postquestion_id');
    }
}
