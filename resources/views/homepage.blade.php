@extends('layouts.template')

@section('title', 'Homepage')

@section('content')
  <div class="container mt-4">
    <h1 class="mb-4">Movies</h1>

    @if(request('search'))
      <div class="mb-3">
        <p class="text-muted">Hasil pencarian untuk: <strong>{{ request('search') }}</strong></p>
      </div>
    @endif

    <div class="row">
      @foreach ($movies as $movie)
        <div class="col-lg-6 mb-4">
          <div class="card h-100">
            <div class="row g-0">
              <div class="col-md-4">
                @php $cover = $movie->cover_image; @endphp
                @if (Str::startsWith($cover, ['http://', 'https://']))
                  <img src="{{ $cover }}" alt="{{ $movie->title }}" class="img-fluid rounded-start" />
                @else
                  <img src="{{ asset('storage/' . $cover) }}" alt="{{ $movie->title }}" class="img-fluid rounded-start" />
                @endif
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">{{ $movie->title }}</h5>
                  <p class="card-text">{{ Str::words($movie->synopsis, 15) }}</p>
                  <p class="card-text">
                    <small class="text-muted">Year: {{ $movie->year }}</small>
                  </p>
                  <a href="/movie/{{ $movie->id }}/{{ $movie->slug }}" class="btn btn-custom">Read More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-4">
      {{ $movies->appends(request()->query())->links() }}
    </div>
  </div>
@endsection
