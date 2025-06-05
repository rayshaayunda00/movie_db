@extends('layouts.template')

@section('title', 'Data Movie')

@section('content')

<h1>Data Movie</h1>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<a href="{{ url('/movie/create') }}" class="btn btn-success mb-3">+ Tambah Movie</a>

<table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Cover</th>
            <th>Title</th>
            <th>Year</th>
            <th>Category</th>
            <th>Actors</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($movies as $index => $movie)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <img src="{{ asset('storage/' . $movie->cover_image) }}" alt="{{ $movie->title }}" width="80">
                </td>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->year }}</td>
                <td>{{ $movie->category->category_name ?? '-' }}</td>
                <td>{{ $movie->actors }}</td>
                <td>
                    <!-- Tombol Edit -->
                    <a href="{{ url('/movie/' . $movie->id . '/edit') }}" class="btn btn-warning btn-sm mb-1">Edit</a>

                    <!-- Tombol Hapus -->
                    <form action="{{ url('/movie/' . $movie->id . '/delete') }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">Tidak ada data movie.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
