@extends('layouts.main')

@section('content')
    {{-- Alert Success --}}
    @if (session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Carousel Film --}}
    <div style="position: relative; width: 100%; overflow: hidden; margin-bottom: 30px;">
        {{-- Tombol Kiri --}}
        <button onclick="slideLeft()"
            style="
                position: absolute;
                left: 0;
                top: 40%;
                z-index: 10;
                background-color: rgba(0,0,0,0.6);
                border: none;
                color: white;
                padding: 10px;
                cursor: pointer;
                font-size: 24px;
                border-radius: 0 5px 5px 0;
            ">
            &#10094;
        </button>

        @php
            $carouselMovies = $featuredMovies->take(8);
            $loopMovies = $carouselMovies->concat($carouselMovies);
        @endphp

        {{-- Wrapper & Container --}}
        <div id="carouselWrapper" style="overflow-x: hidden;">
            <div id="carouselContainer"
                style="
                display: flex;
                gap: 10px;
                scroll-behavior: smooth;
            ">
                @foreach ($loopMovies as $movie)
                    <div style="flex: 0 0 auto; width: 180px; position: relative;">
                        <img src="{{ asset('storage/' . $movie->cover_image) }}" alt="{{ $movie->title }}"
                            style="height: 270px; width: 100%; object-fit: cover; border-radius: 8px;">
                        <div
                            style="
                            position: absolute;
                            bottom: 0;
                            left: 0;
                            width: 100%;
                            background-color: rgba(0,0,0,0.5);
                            color: white;
                            text-align: center;
                            font-size: 14px;
                            padding: 8px;">
                            <strong>{{ $movie->title }}</strong><br>
                            <small>{{ $movie->year }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Tombol Kanan --}}
        <button onclick="slideRight()"
            style="
                position: absolute;
                right: 0;
                top: 40%;
                z-index: 10;
                background-color: rgba(0,0,0,0.6);
                border: none;
                color: white;
                padding: 10px;
                cursor: pointer;
                font-size: 24px;
                border-radius: 5px 0 0 5px;
            ">
            &#10095;
        </button>
    </div>



    {{-- Script Carousel --}}
    {{-- Script Carousel --}}
    <script>
        const container = document.getElementById('carouselContainer');
        const totalCards = container.children.length;
        const cardWidth = 190; // card 180 + 10 gap
        let index = 0;
        let isAnimating = false;

        function scrollToIndex() {
            container.style.transform = `translateX(-${cardWidth * index}px)`;
        }

        function slideRight() {
            if (isAnimating) return;
            isAnimating = true;

            index++;
            if (index >= totalCards / 2) {
                container.style.transition = 'transform 0.5s ease';
                scrollToIndex();

                setTimeout(() => {
                    container.style.transition = 'none';
                    index = 0;
                    scrollToIndex();
                    isAnimating = false;
                }, 500);
            } else {
                container.style.transition = 'transform 0.5s ease';
                scrollToIndex();
                setTimeout(() => isAnimating = false, 500);
            }
        }

        function slideLeft() {
            if (isAnimating) return;
            isAnimating = true;

            if (index <= 0) {
                container.style.transition = 'transform 0.5s ease';
                index = -1;
                scrollToIndex();

                setTimeout(() => {
                    container.style.transition = 'none';
                    index = totalCards / 2 - 1;
                    scrollToIndex();
                    isAnimating = false;
                }, 500);
            } else {
                index--;
                container.style.transition = 'transform 0.5s ease';
                scrollToIndex();
                setTimeout(() => isAnimating = false, 500);
            }
        }

        // Auto-scroll setiap 4 detik (opsional)
        // setInterval(slideRight, 4000);
    </script>




    <h2>Daftar Film Terbaru</h2>

    {{-- List Movie Detail --}}
    <div class="row">
        @foreach ($movies as $movie)
            <div class="col-lg-6 pb-3 col-md-12">
                {{-- Card Movie --}}
                <div class="card mb-3 shadow-sm h-100">
                    <div class="row g-0 h-100">
                        {{-- Gambar --}}
                        <div class="col-md-4">
                            <img src="{{ asset('storage/' . $movie->cover_image) }}"
                                class="img-fluid rounded-start h-100 object-fit-cover" alt="{{ $movie->title }}">
                        </div>

                        {{-- Konten --}}
                        <div class="col-md-8 d-flex flex-column">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $movie->title }}</h5>

                                {{-- Rating --}}
                                <p class="mb-2">
                                    <strong>Rating:</strong>
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $movie->rating)
                                            <span class="text-warning">&#9733;</span>
                                        @else
                                            <span class="text-muted">&#9734;</span>
                                        @endif
                                    @endfor
                                    <span class="text-secondary">({{ $movie->rating }}/5)</span>
                                </p>

                                {{-- Sinopsis --}}
                                <p class="card-text">{{ Str::words($movie->synopsis, 20, '...') }}</p>

                                {{-- Tombol Aksi di Bawah --}}
                                <div class="mt-auto d-flex flex-wrap gap-2">
                                    <a href="/movie/{{ $movie->id }}/{{ $movie->slug }}"
                                        class="btn btn-outline-primary btn-sm">Read More</a>
                                    <a href="{{ $movie->trailer_url }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">Trailer</a>
                                    <a href="{{ $movie->watch_url }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">Watch Movie</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{ $movies->links() }}
        </div>
    </div>



    {{-- Auto Close Alert --}}
    <script>
        setTimeout(function() {
            const alert = document.getElementById('success-alert');
            if (alert) {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }
        }, 3000);
    </script>
@endsection
