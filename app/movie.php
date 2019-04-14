<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
    use traits\MoviesExtraOperations;

    protected $guarded = [];

    public function getSlug() {
        if ($this->category->id == 2) {
            return str_slug($this->name);
        }
        return str_slug($this->getNameWithoutArabic());
    }

    public function serverLinks() {
        return $this->belongsTo('App\ServerLinksForMovies', 'server_links');
    }

    public function getImageUrlAttribute($url) {
        return preg_match('!^http!', $url) ? $url : asset('') . $url;
    }

    public function category() {
        return $this->belongsto('App\Category');
    }
}
