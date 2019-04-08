<?php

namespace App\Http\Controllers;

use App\Movie;

class ServerLinksForMoviesController extends Controller
{
    public function index($slug)
    {
        $Movie = Movie::where('slug', $slug)->first();
        abort_if($Movie===null,404);
        $Movie->views = $Movie->views + 1 ;
        $Movie->save();
        return view('single')
            ->with('movie', $Movie)
            ->with('serverLinks', $Movie->serverLinks->first()->getserverLinksAsArray());
    }
}
