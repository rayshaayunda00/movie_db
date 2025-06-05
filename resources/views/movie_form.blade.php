@extends('layouts.template')

@section('title', 'Homepage')

@section('content')


<h1>Form Input Movie</h1>

<a href="{{ url('/admin/datamovie') }}" class="btn btn-primary mb-3">Data Movie</a>

<form action="/movie/store" method="POST" enctype="multipart/form-data">
    
    @if(isset($movie))
    <form action="{{ url('/movie/' . $movie->id . '/update') }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
@else
    <form action="/movie/store" method="POST" enctype="multipart/form-data">
@endif

    @csrf

    <div class="mb-3 mt-4">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="cover_image" class="form-label">Cover Image</label>
        <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
        @error('cover_image')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="synopsis" class="form-label">Synopsis</label>
        <textarea class="form-control @error('synopsis') is-invalid @enderror" id="synopsis" name="synopsis" rows="3">{{ old('synopsis') }}</textarea>
        @error('synopsis')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="year" class="form-label">Year</label>
        <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year') }}">
        @error('year')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="actors" class="form-label">Actors</label>
        <input type="text" class="form-control @error('actors') is-invalid @enderror" id="actors" name="actors" value="{{ old('actors') }}">
        @error('actors')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->category_name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success mb-3">Simpan</button>
</form>

@endsection
