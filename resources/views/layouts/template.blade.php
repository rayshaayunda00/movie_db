<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Movie - @yield('title', 'Homepage')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    

    <style>
      body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
      }

      .navbar {
        background-color: #6f42c1; /* ungu */
      }

      .navbar .nav-link.active,
      .navbar .nav-link:hover {
        font-weight: bold;
        color: #ffc107 !important;
      }

      .card {
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
        border-radius: 15px;
      }

      .card:hover {
        transform: scale(1.02);
      }

      .btn-custom {
        background-color: #6f42c1;
        color: white;
        border-radius: 20px;
        transition: 0.3s ease;
      }

      .btn-custom:hover {
        background-color: #5a32a3;
      }

      footer {
        background-color: #6f42c1;
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <a class="navbar-brand" href="/">MovieApp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
          aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
            </li>

            @auth
              <li class="nav-item">
                <a class="nav-link {{ request()->is('movie/create') ? 'active' : '' }}" href="/movie/create">Input Movie</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">{{ Auth::user()->name }}</a>
              </li>
              <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="nav-link btn btn-link text-white" style="text-decoration: none;">
                    Logout
                  </button>
                </form>
              </li>
            @else
              <li class="nav-item">
                <a class="nav-link" href="/login">Login</a>
              </li>
            @endauth

            @php
              use App\Models\Movie;
              $usedCategories = Movie::with('category')->get()->pluck('category')->unique('id')->filter()->values();
            @endphp
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Genre
              </a>
              <ul class="dropdown-menu">
                @foreach ($usedCategories as $category)
                  <li>
                    <a class="dropdown-item" href="{{ url('/?genre=' . urlencode($category->category_name)) }}">
                      {{ $category->category_name }}
                    </a>
                  </li>
                @endforeach
              </ul>
            </li>
          </ul>

          <form class="d-flex" role="search" action="{{ url('/') }}" method="GET">
  <input class="form-control me-2" type="search" name="search" value="{{ request('search') }}" placeholder="Search movies..." aria-label="Search" />
  <button class="btn btn-custom" type="submit">Search</button>
</form>

        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-4 py-4">
      @yield('content')
    </div>

    <!-- Footer -->
    <footer class="text-white text-center py-3">
      &copy; 2025 Developed by Raysha
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
