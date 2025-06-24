@extends('layouts.main')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center">
                        <h3 class="mb-4 text-dark border-bottom border-primary pb-2 d-inline-block">
                            Input Film Baru
                        </h3>
                    </div>



                    <form action="/movie" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" name="title" id="title"
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Synopsis --}}
                        <div class="mb-3">
                            <label for="synopsis" class="form-label">Synopsis</label>
                            <textarea name="synopsis" id="synopsis"
                                class="form-control @error('synopsis') is-invalid @enderror"
                                rows="4" required>{{ old('synopsis') }}</textarea>
                            @error('synopsis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="">-- choose Category --</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}" {{ old('category_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Year --}}
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" name="year" id="year"
                                class="form-control @error('year') is-invalid @enderror"
                                value="{{ old('year') }}" required>
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Actors --}}
                        <div class="mb-3">
                            <label for="actors" class="form-label">Actors</label>
                            <input type="text" name="actors" id="actors"
                                class="form-control @error('actors') is-invalid @enderror"
                                value="{{ old('actors') }}" required>
                            @error('actors')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Cover Image --}}
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Cover Image</label>
                            <input type="file" name="cover_image" id="cover_image"
                                class="form-control @error('cover_image') is-invalid @enderror" required>
                            @error('cover_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="/movie" class="btn btn-secondary">← Back</a>
                            <button type="submit" class="btn btn-primary">save Film</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
