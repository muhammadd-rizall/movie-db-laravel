<?php

namespace App\Http\Controllers;


use App\Models\Movie;
use Illuminate\Http\Request;


class MovieController extends Controller
{

    public function homePage(){
        $movies = Movie:: latest()->paginate(6);
        return view('movies.homepage', compact('movies'));
    }

    public function detail($id, $slug){
        $movie = Movie :: find($id);
        return view('movies.detailmovie', compact('movie'));
    }
}
