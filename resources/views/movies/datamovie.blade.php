@extends('layouts.main')

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Data Movie</h1>
        <a href="/create-movie" class="btn btn-primary mb-3">Tambah Movie</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th style="width: 5%">NO</th>
                        <th style="width: 30%">Title</th>
                        <th style="width: 20%">Category</th>
                        <th style="width: 15%">Year</th>
                        <th style="width: 30%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($movies as $index => $movie)
                        <tr>
                            <td class="text-center">{{ $index + $movies->firstItem() }}</td>
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->category->category_name }}</td>
                            <td class="text-center">{{ $movie->year }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="/movie/{{ $movie->id }}/{{ $movie->slug }}" class="btn btn-sm btn-primary">Show</a>
                                    <a href="/editmovie/{{ $movie->id }}" class="btn btn-sm btn-warning">Edit</a>
                                    @can('delete')
                                        <form action="/movie-delete/{{ $movie->id }}" method="POST" onsubmit="return confirm('Are you sure to delete this movie?')">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data film.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $movies->links() }}
        </div>
    </div>
@endsection
