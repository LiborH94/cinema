<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MoviesRequest;
use App\Models\Movie;

class MovieController extends Controller
{
    public function index()
    {
        return view('admin.movies.index', [
            'movies' => Movie::all()
        ]);
    }
    public function create()
    {
        return view('admin.movies.create');
    }
    public function store(MoviesRequest $request)
    {
        $request->validated();

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('movies', 'public');
        }

        Movie::create(
            $request->only(['name', 'description']) + ['image_path' => $imagePath]
        );
        return redirect()->route('admin.movies.index')->with('success', 'Film byl přidán!');
    }

    public function show(Movie $movie)
    {
        return view('admin.movies.show', [
            'movie' => $movie
        ]);
    }

    public function edit(Movie $movie)
    {
        return view('admin.movies.edit', [
            'movie' => $movie
        ]);
    }

    public function update(MoviesRequest $request, Movie $movie)
    {
        $validated = $request->validated();
        $movie->update($validated);
        return redirect()->route('admin.movies.show', $movie)->with('success', 'Film byl úspěšně upraven.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.movies.index');
    }
}
