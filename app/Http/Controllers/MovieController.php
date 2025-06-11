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

    // Filter pencarian
    if ($request->filled('search')) {
        $query->where('title', 'like', '%' . $request->search . '%');
    }

    // Filter genre/kategori
    if ($request->filled('genre')) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->where('category_name', $request->genre);
        });
    }

    // Paginate hasil query yang sudah difilter
    $movies = $query->paginate(10)->appends($request->query());

    $categories = Category::all();

    return view('homepage', compact('movies', 'categories'));
}


      public function dataMovie()
        {
            $movies = Movie::with('category')->paginate(10);
            return view('admin.datamovie', compact('movies'));
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
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
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
            'release_year' => $validated['release_year'],
            'actors' => $validated['actors'],
            'category_id' => $validated['category_id'],
        ]);

        return redirect('/admin/datamovie')->with('success', 'Movie berhasil ditambahkan!');

    }
     public function destroy($id)
{
    $movie = Movie::findOrFail($id);

    // Hapus file gambar dari penyimpanan jika perlu
    if ($movie->cover_image && \Storage::disk('public')->exists($movie->cover_image)) {
        \Storage::disk('public')->delete($movie->cover_image);
    }

    $movie->delete();

    return redirect('/admin/datamovie')->with('success', 'Movie berhasil dihapus!');
}


    public function edit($id)
{
    $movie = Movie::findOrFail($id);
    $categories = Category::all();
    return view('movie_edit', compact('movie', 'categories'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'synopsis' => 'nullable|string',
        'release_year' => 'required|integer|min:1900|max:' . date('Y'),
        'actors' => 'required|string',
        'category_id' => 'required|exists:categories,id',
    ]);

    $movie = Movie::findOrFail($id);

    // Handle cover image update
    if ($request->hasFile('cover_image')) {
        $imagePath = $request->file('cover_image')->store('covers', 'public');
        $movie->cover_image = $imagePath;
    }

    $movie->update([
        'title' => $validated['title'],
        'slug' => \Str::slug($validated['title']),
        'synopsis' => $validated['synopsis'],
        'release_year' => $validated['release_year'],
        'actors' => $validated['actors'],
        'category_id' => $validated['category_id'],
    ]);

    $movie->save();

    return redirect()->route('admin.datamovie', $movie->id)->with('success', 'Movie berhasil diperbarui!');
}


}
