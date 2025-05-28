<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::with('category');

        // Pencarian berdasarkan judul
        if ($request->has('search') && $request->search !== '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan genre
        if ($request->has('genre') && $request->genre !== '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('category_name', $request->genre);
            });
        }

        // Ambil data film terbaru
        $movies = $query->latest()->paginate(6);

        return view('homepage', compact('movies'));
    }

    public function detail_movie($id, $slug)
    {
        $movie = Movie::find($id);
        return view('movie_detail', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('movie_form', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'synopsis' => 'nullable|string',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'actors' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $slug = Str::slug($request->title);

        // Simpan gambar
        $imagePath = $request->file('cover_image')->store('covers', 'public');

        // Simpan ke database
        Movie::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'cover_image' => $imagePath,
            'synopsis' => $validated['synopsis'],
            'year' => $validated['year'],
            'actors' => $validated['actors'],
            'category_id' => $validated['category_id'],
        ]);

        return redirect('/')->with('success', 'Movie berhasil ditambahkan!');
    }
}
