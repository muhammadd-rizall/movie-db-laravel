@extends('layouts.main')
@section('content')
    <h1>Data Movie</h1>
    <a href="/create-movie" class="btn btn-success mb-3 mt-3">Tambah Movie</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>NO</th>
                <th>Title</th>
                <th>Category</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($movies as $index => $movie)
            <tr>
                <td>{{ $index + $movies->firstItem() }}</td>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->category->category_name }}</td>
                <td>{{ $movie->year }}</td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="" class="btn btn-success btn-sm">Show</a>
                        <a href="/editmovie/{{ $movie->id }}" class="btn btn-warning btn-sm">Edit</a>
                        @can('delete')
                            <form action="/movie-delete/{{ $movie->id }}" method="post">
                                @csrf
                                <button onclick="return confirm('are you sure to delete this movie')"
                                    class="btn btn-danger btn-sm">delete</button>
                            </form>
                        @endcan

                    </div>
                </td>
            </tr>
            @endforeach
            </tr>
        </tbody>
    </table>
    {{ $movies->links() }}
@endsection
