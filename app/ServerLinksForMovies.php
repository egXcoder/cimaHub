<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerLinksForMovies extends Model
{
    protected $table = 'server_links_movies';
    public $timestamps = false;
    protected $guarded = [];

    public function getserverLinksAsArray(){
        $servers = [];
        if($this->server_1 != null)  $servers[] = $this->server_1;
        if($this->server_2 != null)  $servers[] = $this->server_2;
        if($this->server_3 != null)  $servers[] = $this->server_3;
        if($this->server_4 != null)  $servers[] = $this->server_4;
        if($this->server_5 != null)  $servers[] = $this->server_5;
        if($this->server_6 != null)  $servers[] = $this->server_6;
        if($this->server_7 != null)  $servers[] = $this->server_7;
        if($this->server_8 != null)  $servers[] = $this->server_8;
        if($this->server_9 != null)  $servers[] = $this->server_9;
        if($this->server_10 != null) $servers[] = $this->server_10;
        return $servers;
    }
    public function setServerLinks($servers){
        $counter = 1;
        foreach($servers as $server){
            $this->update(['server_'.$counter => $server]);
            $counter++;
        }
    }

    public function movie(){
        return $this->belongsTo('App\Movie');
    }
}
