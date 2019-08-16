<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\User;
use App\Comment;

class Comment extends Model
{
    public function post(){
        return $this->belongTo('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
