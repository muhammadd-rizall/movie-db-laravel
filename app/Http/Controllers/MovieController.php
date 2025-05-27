<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Contracts\Service\Attribute\Required;

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

    public function create(){
        $categories = Category::all();
        return view('movies.create_movie', compact('categories'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'title' =>'required|string|max:255',
            'synopsis' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'actors' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,jpg,webp'
        ]);

        $slug = Str::slug($request->title);

        //ambil input file dan simpan ke storage
        $cover = null;
        if ($request -> hasFile('cover_image')){
            $cover = $request->file('cover_image')->store('covers', 'public');
        }

        //simpan ke tabel movies
        Movie::create(
            [
                'title' => $validated['title'],
                'slug' => $slug,
                'synopsis' => $validated['synopsis'],
                'category_id' => $validated['category_id'],
                'year' => $validated['year'],
                'actors' => $validated['actors'],
                'cover_image' => $cover,
            ]
        );

        return redirect('/')->with('success', 'Movie Saved Successfully');
    }
}
