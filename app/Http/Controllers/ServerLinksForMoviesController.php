<?php

namespace App\Http\Controllers;

use App\Movie;

class ServerLinksForMoviesController extends Controller
{
    public function index($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        abort_if(($movie === null), 404);
        $this->increase_views($movie);
        $serverLinks = $movie->serverLinks->getserverLinksAsArray();
        $downloadLinks = $movie->downloadLinks->getDownloadLinksAsArray();
        
        if($serverLinks === []){
            $movie->delete();
            abort(404);
        }

        return view('single')
            ->with('title', $movie->name)
            ->with('movie', $movie)
            ->with('serverLinks', $serverLinks)
            ->with('downloadLinks', $downloadLinks);
    }

    private function increase_views($movie){
        $movie->views = $movie->views + 1 ;
        $movie->save();
    }

}
