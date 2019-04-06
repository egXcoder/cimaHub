<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class Movie extends Model
{
    use traits\MoviesExtraOperations;

    protected $guarded = [];

    public function serverLinks()
    {
        return $this->hasMany('App\serverLinksMovies', 'id');
    }

    public function getImageUrlAttribute($url)
    {
        return asset('') . $url;
    }

}