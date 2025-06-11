@extends('layouts.template')

@section('title', 'Edit Movie')

@section('content')
<h1>Edit Movie</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('movie.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $movie->title) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Cover Image</label><br>
        <img src="{{ asset('storage/' . $movie->cover_image) }}" width="100"><br>
        <input type="file" name="cover_image" class="form-control mt-2">
    </div>

    <div class="mb-3">
        <label class="form-label">Synopsis</label>
        <textarea name="synopsis" class="form-control">{{ old('synopsis', $movie->synopsis) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Year</label>
        <input type="number" name="release_year" class="form-control" value="{{ old('release_year', $movie->release_year) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Actors</label>
        <input type="text" name="actors" class="form-control" value="{{ old('actors', $movie->actors) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $movie->category_id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Movie</button>
</form>
@endsection
