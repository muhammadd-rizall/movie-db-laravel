@extends('layouts.main')

@section('content')
    <h1>Input New Movie</h1>
    <form action="/movie" method="post" enctype="multipart/form-data">
        @csrf

        {{-- title --}}
        <div class="mb-3 row">
            <label for="title" class="col-sm-2 col-form-label">Title :</label>
            <div class="col-sm-10">
                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                    value="{{ old('title') }}">

                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- synopsis --}}
        <div class="mb-3 row">
            <label for="synopsis" class="col-sm-2 col-form-label">Synopsis :</label>
            <div class="col-sm-10">
                <textarea name="synopsis" id="synopsis" class="form-control
                    @error('synopsis')
                is-invalid @enderror">{{ old('synopsis') }}</textarea>

                @error('synopsis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- category --}}
        <div class="mb-3 row">
            <label for="category_id" class="col-sm-2 col-form-label">Category</label>
            <div class="col-sm-10">
                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">-- Pilih Kategori --</option>
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
        </div>

        {{-- year --}}
        <div class="mb-3 row">
            <label for="year" class="col-sm-2 col-form-label">Year :</label>
            <div class="col-sm-10">
                <input type="number" name="year" id="year" class="form-control @error('year') is-invalid @enderror"
                    value="{{ old('year') }}">

                @error('year')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Actor --}}
        <div class="mb-3 row">
            <label for="actors" class="col-sm-2 col-form-label">Actors :</label>
            <div class="col-sm-10">
                <input type="text" name="actors" id="actors" class="form-control
                    @error('actors') is-invalid @enderror" value="{{ old('actors') }}">

                @error('actors')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Cover Image --}}
        <div class="mb-3 row">
            <label for="cover_image" class="col-sm-2 col-form-label">Cover Image :</label>
            <div class="col-sm-10">
                <input type="file" name="cover_image" id="cover_image" class="form-control
                    @error('cover_image') is-invalid @enderror"  value="{{ old('cover_image') }}">

                @error('cover_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="mb-3 row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="/movie" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>
@endsection
