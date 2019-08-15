<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\User;
use Laravel\Passport\HasApiTokens;

class Post extends Model
{
    public function postUser(){
        return $this->belongsTo('App\User');
    }
}
