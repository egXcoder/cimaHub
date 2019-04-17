<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MoviesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        session()->put('search', $request->has('search') ? $request->search : (session()->has('search') ? session('search') : ''));

        $query = DB::raw('1-(id/(SELECT MAX(id) FROM movies))+views/(SELECT MAX(views) FROM movies)+ratings/10 DESC');

        if ($request->ajax()) {
            if (session('search') == '') {
                return null;
            }
            $movies = Movie::where('name', 'like', '%' . session('search') . '%')
                        ->orderByRaw($query)
                        ->paginate(36);
            return view('Ajax', ['movies' => $movies]);
        } else {
            $newest_movies = Movie::Where('category_id', 1)
                                ->orderBy('id', 'DESC')->take(20);

            $rated_movies = Movie::Where('category_id', 1)
                        ->orderByRaw($query);

            $movies = $newest_movies->union($rated_movies)->paginate(36);
            return view('index', ['movies' => $movies, 'title' => 'home']);
        }
    }

    public function getArabicMovies() {
        $movies = Movie::Where('category_id', 2)->paginate(36);
        return view('index', ['movies' => $movies, 'pageTitle' => 'افلام عربى', 'title' => 'arabic']);
    }
}
