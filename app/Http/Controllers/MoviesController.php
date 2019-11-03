<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Genre;

class MoviesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $query;

    public function __construct(){
        $this->query = DB::raw('1-(id/(SELECT MAX(id) FROM movies))+views/(SELECT MAX(views) FROM movies)+ratings/10 DESC');
    }

    public function index() {
        return view('index', [
            'new_movies'=>Movie::latest()->take(10)->get(),
            'top_rated' => Movie::orderBy('ratings','DESC')->latest()->take(10)->get(),
            'english_movies' => Movie::Where('category_id', 1)->latest()->take(16)->get(), 
            'indian_movies' => Movie::Where('category_id', 4)->latest()->take(16)->get(),
            'animation_movies' => Movie::Where('category_id', 3)->latest()->take(16)->get(),
            'title' => 'home'
        ]);
    }

    public function ajax_search(Request $request){
        abort_unless($request->ajax(),404);
        session()->put('search', $request->has('search')
                                 ? $request->search
                                 : (session()->has('search') ? session('search') : ''));

        if (session('search') == '') return null;

        $movies = Movie::where('name', 'like', '%' . session('search') . '%')
                    ->orderByRaw($this->query)
                    ->paginate(36);
        return view('Ajax', ['movies' => $movies]);                         
    }

    public function getMoviesEnglish(){
        $newest_movies = Movie::Where('category_id', 1)
                            ->orderBy('id', 'DESC')->take(20);

        $rated_movies = Movie::Where('category_id', 1)
                    ->orderByRaw($this->query);

        $movies = $newest_movies->union($rated_movies)->paginate(36);
        return view('sections', ['movies' => $movies, 'title' => 'english']);
    }

    public function getMoviesIndian(){
        $newest_movies = Movie::Where('category_id', 4)
                            ->orderBy('id', 'DESC')->take(20);

        $rated_movies = Movie::Where('category_id', 4)
                    ->orderByRaw($this->query);

        $movies = $newest_movies->union($rated_movies)->paginate(36);
        return view('sections', ['movies' => $movies, 'title' => 'english']);
    }

    public function getMoviesAnimation(){
        $newest_movies = Movie::Where('category_id', 3)
                            ->orderBy('id', 'DESC')->take(20);

        $rated_movies = Movie::Where('category_id', 3)
                    ->orderByRaw($this->query);

        $movies = $newest_movies->union($rated_movies)->paginate(36);
        return view('sections', ['movies' => $movies, 'title' => 'english']);
    }

    public function getMoviesByGenre($name){
        $movies = Genre::where('name',$name)->get()[0]->movie()->paginate(35);
        return view('sections', ['movies' => $movies, 'title' => 'home']);
    }
}
