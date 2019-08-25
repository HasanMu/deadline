<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function postquestion()
    {
        return $this->belongsToMany('App\PostQuestion', 'postsquestions_tags', 'tags_id', 'postquestion_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
