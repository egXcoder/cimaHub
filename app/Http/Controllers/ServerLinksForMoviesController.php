<?php

namespace App\Http\Controllers;

use App\Movie;

class ServerLinksForMoviesController extends Controller
{
    public function index($slug)
    {
        $movie = Movie::where('slug', $slug)->first();
        abort_if($movie === null, 404);
        $this->increase_views($movie);
        return view('single')
            ->with('title', $movie->name)
            ->with('movie', $movie)
            ->with('serverLinks', $movie->serverLinks->getserverLinksAsArray());
    }

    private function increase_views($movie)
    {
        $movie->views = $movie->views + 1 ;
        $movie->save();
    }

}
