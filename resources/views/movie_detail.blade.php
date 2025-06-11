@extends('layouts.template')

@section('title', 'Detail Movie')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="row g-0">
            <div class="col-md-4">
                @php $cover = $movie->cover_image; @endphp
                <img
                    src="{{ Str::startsWith($cover, ['http://', 'https://']) ? $cover : asset('storage/' . $cover) }}"
                    alt="{{ $movie->title }}"
                    class="img-fluid h-100 object-fit-cover rounded-start"
                    style="object-fit: cover;"
                />
            </div>
            <div class="col-md-8">
                <div class="card-body p-4">
                    <h3 class="card-title fw-bold mb-3 text-primary">{{ $movie->title }}</h3>

                    <p class="card-text text-muted"><strong>🎭 Pemeran:</strong> {{ $movie->actors }}</p>
                    <p class="card-text"><strong>📂 Kategori:</strong> {{ $movie->category->category_name ?? '-' }}</p>
                    <p class="card-text"><strong>📅 Tahun Rilis:</strong> {{ $movie->release_year }}</p>

                    <hr>

                    <p class="card-text text-dark"><strong>📝 Sinopsis:</strong><br>{{ $movie->synopsis }}</p>

                    <a href="{{ url('/admin/datamovie') }}" class="btn btn-outline-secondary mt-3">
                        ← Kembali ke Daftar Movie
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
