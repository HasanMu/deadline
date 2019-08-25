<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function postquestion()
    {
        return $this->belongsTo('App\PostQuestion', 'postquestion_id');
    }
}
