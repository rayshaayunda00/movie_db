@extends('layout.template')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 fw-bold">Popular Movie</h2>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($movies as $movie)
        <div class="col">
            <div class="card h-100 border-0 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ $movie->cover_image }}" class="img-fluid rounded-start h-100 w-100 object-fit-cover" alt="{{ $movie->title }}">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold">{{ \Illuminate\Support\Str::limit($movie->title, 50) }}</h5>
                            <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($movie->synopsis, 180) }}</p>
                            <a href="{{ route('movies.show', $movie->slug) }}" class="btn btn-success btn-sm mt-2">Lihat Selanjutnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $movies->links() }}
    </div>
</div>
@endsection

