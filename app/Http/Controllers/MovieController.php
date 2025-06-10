<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

    public function dataMovie(){
        $movies = Movie::latest()->paginate(10);
        return view('movies.datamovie', data:['movies' => $movies]);
    }

    public function edit($id)
    {
        $categories = Category::all();
        $movie = Movie::find($id);
        return view('movies.editmovie', compact('categories', 'movie'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required|digits:4|integer|min:1901|max:' . date('Y'),
            'actors' => 'required',
            'cover_image' => 'nullable|image',
        ]);

        $movie = Movie::findOrFail($id); // cari movie berdasarkan ID

        $slug = Str::slug($validated['title']);

        // Cek apakah ada file baru yang diupload
        if ($request->hasFile('cover_image')) {
            $cover = $request->file('cover_image')->store('covers', 'public');
            $movie->cover_image = $cover;
        }

        // Update data
        $movie->title = $validated['title'];
        $movie->slug = $slug;
        $movie->synopsis = $validated['synopsis'];
        $movie->category_id = $validated['category_id'];
        $movie->year = $validated['year'];
        $movie->actors = $validated['actors'];

        $movie->save(); // simpan ke database

        return redirect(route('dataMovie'))->with('success', 'Movie updated successfully');
    }

    public function delete($id){

       if(Gate::allows('delete')){
            echo "Delete Movie with ID: $id";
       }else {
            abort(403, 'Unauthorized action.');
       }
    }
}
