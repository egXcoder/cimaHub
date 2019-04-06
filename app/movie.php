<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use traits\MoviesExtraOperations;

    protected $guarded = [];

    public function getSlug()
    {
        return str_slug($this->getNameWithoutArabic());
    }

    public function serverLinks()
    {
        return $this->hasMany('App\ServerLinksForMovies', 'id');
    }

    public function getImageUrlAttribute($url)
    {
        return asset('') . $url;
    }
}
