<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DB::raw('id/(SELECT MAX(id) FROM movies)+views/(SELECT MAX(views) FROM movies)+ratings/(SELECT MAX(ratings) FROM movies) DESC');
        $movies = Movie::Where('category_id',1)->orderByRaw($query)->paginate(28);
        return view('index', ['movies' => $movies,"pageTitle"=>"الرئيسية"]);
    }
    public function getArabicMovies(){
        $movies = Movie::Where('category_id', 2)->paginate(28);
        return view('index', ['movies' => $movies,"pageTitle"=>"افلام عربى"]);
    }

}
