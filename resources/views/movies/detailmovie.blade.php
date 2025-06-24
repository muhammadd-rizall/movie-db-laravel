@extends('layouts.main')
@section('content')

<div class="container py-4">
    <div class="card shadow-lg border-0">
        <div class="row g-0">
            {{-- Poster --}}
            <div class="col-md-5">
                <img src="{{ asset('storage/' . $movie->cover_image) }}" alt="{{ $movie->title }}"
                    class="img-fluid w-100 h-100 rounded-start object-fit-cover border"
                    style="object-fit: cover; border-width: 1px; border-color: #dee2e6;">
            </div>

            {{-- Detail --}}
            <div class="col-md-7">
                <div class="card-body d-flex flex-column h-100">
                    <h3 class="card-title text-dark mb-2">{{ $movie->title }}</h3>

                    {{-- Garis biru cantik di bawah judul --}}
                    <div style="width: 120px; height: 3px; background: #0d6efd; border-radius: 10px; margin-bottom: 20px;"></div>

                    <p class="text-muted mb-1"><strong>Year:</strong> {{ $movie->year }}</p>
                    <p class="text-muted mb-1"><strong>Category:</strong> {{ $movie->category->category_name }}</p>
                    <p class="text-muted mb-3"><strong>Actor:</strong> {{ $movie->actors }}</p>

                    <h5 class="mt-3">Sinopsis</h5>
                    <p class="card-text">{{ $movie->synopsis }}</p>

                    {{-- Tombol Aksi --}}
                    <div class="mt-auto d-flex flex-wrap gap-2">
                        <a href="/" class="btn btn-outline-primary">Back</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
