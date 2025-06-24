@extends('layouts.main')

@section('content')
<div class="container py-5" style="background-color: #f8f9fa;">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-1" style="background-color: rgba(255, 255, 255, 0.95); border-radius: 10px;">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4" style="font-size: 2rem; color: #007bff;">Login</h4>

                    <form action="/login" method="POST">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" required autofocus>
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        {{-- Remember Me --}}
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>

                    {{-- Optional Link --}}
                    <div class="text-center mt-3">
                        <small>
                            Belum punya akun? <a href="/register">Daftar di sini</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
