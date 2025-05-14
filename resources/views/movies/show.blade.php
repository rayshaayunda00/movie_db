@extends('layout.template')

@section('content')
    <div class="card">
        <img src="{{ $movie->cover_image }}" class="card-img-top" alt="{{ $movie->title }}">
        <div class="card-body">
            <h3 class="card-title">{{ $movie->title }}</h3>
            <p class="card-text">{{ $movie->synopsis }}</p>
            <p><strong>Actors:</strong> {{ $movie->actors }}</p>
            <p><strong>Year:</strong> {{ $movie->year }}</p>
            <a href="{{ route('movies.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
