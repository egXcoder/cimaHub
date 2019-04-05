<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function serverLinks(){
        return $this->hasMany('App\serverLinksMovies','id');
    }
}
