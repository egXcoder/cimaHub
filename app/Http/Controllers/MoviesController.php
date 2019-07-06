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

    public function index(Request $request) {

        if ($request->ajax()) return $this->ajax_search($request);    
        
        $newest_movies = Movie::Where('category_id', 1)
                            ->orderBy('id', 'DESC')->take(20);

        $rated_movies = Movie::Where('category_id', 3)
                    ->orderByRaw($this->query);

        $movies = $newest_movies->union($rated_movies)->paginate(36);
        return view('index', ['movies' => $movies, 'title' => 'home']);
    
    }

    protected function ajax_search(Request $request){
        session()->put('search', $request->has('search')
                                 ? $request->search
                                 : (session()->has('search') ? session('search') : ''));

        if (session('search') == '') return null;

        $movies = Movie::where('name', 'like', '%' . session('search') . '%')
                    ->orderByRaw($this->query)
                    ->paginate(36);
        return view('Ajax', ['movies' => $movies]);                         
    }
    public function getMoviesByGenre($name){
        $movies = Genre::where('name',$name)->get()[0]->movie()->paginate(35);
        return view('index', ['movies' => $movies, 'title' => 'home']);
    }
}
