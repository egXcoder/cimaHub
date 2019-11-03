<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Movie extends Model {
    use traits\MoviesExtraOperations;
    use traits\MoviesPopulationExtraInfo;

    protected $guarded = [];

    public function getSlug() {
        return str_slug($this->name,'-',false);
    }

    public function getImageUrlAttribute($url) {
        return preg_match('!^http!', $url) ? $url : asset('') . $url;
    }

    public function category() {
        return $this->belongsto('App\Category');
    }

    public function serverLinks() {
        return $this->hasOne('App\ServerLinksForMovies');
    }

    public function downloadLinks() {
        return $this->hasOne('App\DownloadLinksForMovies');
    }

    public function actor(){
        return $this->belongsToMany('App\Actor');
    }

    public function genre(){
        return $this->belongsToMany('App\Genre');
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('age',function(Builder $builder){
            $builder->where('quality','!=','0');
        });
    }
}
