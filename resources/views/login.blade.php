@extends('layouts.template')
@section('content')

<style>
    body {
        background: linear-gradient(to bottom right, #d1c4e9, #ede7f6); /* ungu pastel */
        font-family: 'Poppins', sans-serif;
    }

    .card-form {
        max-width: 420px;
        margin: 70px auto;
        padding: 35px;
        border-radius: 20px;
        background-color: #fff;
        box-shadow: 0 8px 20px rgba(103, 58, 183, 0.15);
        border: 1px solid #ce93d8;
    }

    .form-label {
        font-weight: 600;
        color: #6a1b9a; /* ungu tua */
    }

    .form-control {
        border: 2px solid #ce93d8;
        border-radius: 12px;
        padding: 10px 14px;
        transition: 0.3s ease;
    }

    .form-control:focus {
        border-color: #ab47bc;
        box-shadow: 0 0 0 0.2rem rgba(171, 71, 188, 0.25);
    }

    .btn-purple {
        background-color: #7e57c2;
        color: white;
        border: none;
        border-radius: 12px;
        padding: 10px 0;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .btn-purple:hover {
        background-color: #5e35b1;
    }

    .form-check-label {
        color: #6a1b9a;
    }

    .text-danger {
        font-size: 0.875rem;
    }

    .form-text {
        color: #6c757d;
    }
</style>

<div class="card-form">
    <h3 class="text-center mb-4" style="color: #6a1b9a;">Login Akun</h3>
    <form action="/login" method="post">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email"
                   name="email"
                   id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="Masukkan email kamu"
                   aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Email kamu aman bersama kami 🌸</div>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   id="exampleInputPassword1"
                   placeholder="••••••••">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox"
                   class="form-check-input"
                   id="remember"
                   name="remember">
            <label class="form-check-label" for="remember">Ingat saya di alam ungu 💜</label>
        </div>

        <button type="submit" class="btn btn-purple w-100">Masuk</button>
    </form>
</div>

@endsection
