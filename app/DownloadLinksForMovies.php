<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadLinksForMovies extends Model
{
    protected $table = 'download_links_movies';
    public $timestamps = false;
    protected $guarded = [];
    public function set_download_link($download_link){
            if($this->server_1 === null) {$this->update(['server_1' => $download_link]); return;}
            if($this->server_2 === null) {$this->update(['server_2' => $download_link]); return;}
            if($this->server_3 === null) {$this->update(['server_3' => $download_link]); return;}
            if($this->server_4 === null) {$this->update(['server_4' => $download_link]); return;}
            if($this->server_5 === null) {$this->update(['server_5' => $download_link]); return;}
            if($this->server_6 === null) {$this->update(['server_6' => $download_link]); return;}
            if($this->server_7 === null) {$this->update(['server_7' => $download_link]); return;}
            if($this->server_8 === null) {$this->update(['server_8' => $download_link]); return;}
            if($this->server_9 === null) {$this->update(['server_9' => $download_link]); return;}
            if($this->server_10 === null) {$this->update(['server_10' => $download_link]); return;}        
    }
    public function movie(){
        return $this->belongsTo('App\Movie');
    }
}
