<?php

namespace App\Http\Controllers;

use App\Movie;

class ServerLinksForMoviesController extends Controller
{
    public function index($slug)
    {
        $Movie = Movie::where('slug', $slug)->first();
        return view('single')
            ->with('movie', $Movie)
            ->with('serverLinks', $Movie->serverLinks->first()->getserverLinksAsArray());
    }

}
