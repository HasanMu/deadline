<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function postquestion()
    {
        return $this->hasMany('App\PostQuestion', 'category_id');
    }
}
