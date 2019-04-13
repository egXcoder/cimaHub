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
            ->with('title', $this->get_title_of_page($movie))
            ->with('movie', $movie)
            ->with('serverLinks', $movie->serverLinks->first()->getserverLinksAsArray());
    }

    private function increase_views($movie)
    {
        $movie->views = $movie->views + 1 ;
        $movie->save();
    }

    private function get_title_of_page($movie)
    {
        if ($movie->category_id === 1) {
            return 'home';
        }
        if ($movie->category_id === 2) {
            return 'arabic';
        }
    }
}
