@extends('layouts.main')

@section('content')
    <h1>Latest Movies</h1>
    @if (session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert" >
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" autocomplete="close"></button>
        </div>
    @endif
    <div class="row">
        {{-- looping data movie --}}
        @foreach ($movies as $movie)
            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/'.$movie->cover_image) }}" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $movie->title }}</h5>
                                <p class="card-text">{{ Str::words($movie->synopsis, 20, '...') }}</p>
                                <a href="/movie/{{ $movie->id }}/{{ $movie->slug }}" class="btn btn-success">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- end looping --}}
        {{ $movies->links() }}
    </div>

    <script>
        setTimeout(function(){
            var alert = document.getElementById('success-alert');
            if(alert){
                var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }
        }, 3000);
    </script>
@endsection

