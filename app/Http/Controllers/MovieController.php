<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $movies = $query->latest()->paginate(6);
        return view('movies.index', compact('movies'));
    }

    public function show($slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();
        return view('movies.show', compact('movie'));
    }
}
