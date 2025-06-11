@extends('layouts.template')

@section('title', 'Form Input Movie')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Form Input Movie</h2>
        <a href="{{ url('/admin/datamovie') }}" class="btn btn-secondary btn-sm">
            ← Data Movie
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body px-4 py-5">
            <form action="{{ isset($movie) ? route('movie.update', $movie->id) : route('movie.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($movie))
                @method('PUT')
            @endif


                <div class="mb-3">
                    <label for="title" class="form-label">Judul Film</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title" value="{{ old('title', $movie->title ?? '') }}"
                           placeholder="Contoh: The Batman" autofocus>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                @if(isset($movie) && $movie->cover_image)
                    <div class="mb-3">
                        <label class="form-label">Cover Saat Ini</label><br>
                        <img src="{{ asset('storage/' . $movie->cover_image) }}" width="120" class="img-thumbnail rounded">
                    </div>
                @endif

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Upload Cover</label>
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" name="cover_image" id="cover_image">
                    @error('cover_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="synopsis" class="form-label">Sinopsis</label>
                    <textarea class="form-control @error('synopsis') is-invalid @enderror"
                              id="synopsis" name="synopsis" rows="3"
                              placeholder="Tuliskan sinopsis singkat...">{{ old('synopsis', $movie->synopsis ?? '') }}</textarea>
                    @error('synopsis')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="year" class="form-label">Tahun Rilis</label>
                        <input type="number" class="form-control @error('release_year') is-invalid @enderror"
                               id="release_year" name="release_year" value="{{ old('release_year', $movie->release_year ?? '') }}"
                               placeholder="Contoh: 2024" min="1900" max="2099">
                        @error('release_year')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="actors" class="form-label">Pemeran</label>
                        <input type="text" class="form-control @error('actors') is-invalid @enderror"
                               id="actors" name="actors" value="{{ old('actors', $movie->actors ?? '') }}"
                               placeholder="Contoh: Timothée Chalamet, Zendaya">
                        @error('actors')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="form-label">Kategori</label>
                    <select class="form-select @error('category_id') is-invalid @enderror"
                            id="category_id" name="category_id">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $movie->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ isset($movie) ? 'Update Movie' : 'Simpan Movie' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
