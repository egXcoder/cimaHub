<?php

namespace App\Http\Controllers;

use App\Movie;

class ServerLinksForMoviesController extends Controller
{
    public function index(Movie $movie)
    {
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

    protected function increase_views($movie){
        $movie->views = $movie->views + 1 ;
        $movie->save();
    }
}
