<style>
    /* Garis biru bawah navbar */
    .navbar {
        border-bottom: 8px solid #0d6efd;
        /* Biru Bootstrap */
    }

    /* Link aktif & hover dengan garis bawah biru */
    .nav-link.active,
    .nav-link:hover {
        color: #0d6efd !important;
        border-bottom: 2px solid #0d6efd;
    }

    /* Dropdown menu item hover */
    .dropdown-menu .dropdown-item:hover {
        background-color: #0d6efd;
        color: #fff;
    }

    /* Tombol search fokus/klik */
    .btn-outline-light:active,
    .btn-outline-light:focus {
        background-color: #0d6efd !important;
        color: white !important;
        border-color: #0d6efd !important;
    }

    /* Tombol logout (form button) hover */
    form button.btn-link:hover {
        color: #0d6efd !important;
    }
</style>


<header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="/">Movie DB</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dataMovie') }}">Data Movie</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">{{ Auth::user()->email }}</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-link text-decoration-none text-white">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                </ul>

                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
</header>
