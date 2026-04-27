<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MoviesRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Gate;

class MovieController extends Controller
{
    public function index()
    {
        if(!Gate::allows('isAdmin')){
            abort(404);
        }
        return view('admin.movies.index', [
            'movies' => Movie::all()
        ]);
    }
    public function create()
    {
        if(!Gate::allows('isAdmin')){
            abort(404);
        }
        return view('admin.movies.create');
    }
    public function store(MoviesRequest $request) {

        if(!Gate::allows('isAdmin')){
            abort(404);
        }
        $validated = $request->validated();
        Movie::create($validated);
        return redirect()->route('admin.movies.index')->with('success', 'Film byl úspěšně přidán!');
    }

    public function show(Movie $movie)
    {
        if(!Gate::allows('isAdmin')){
            abort(404);
        }
        return view('admin.movies.show', [
            'movie' => $movie
        ]);
    }

    public function edit(Movie $movie)
    {
        if(!Gate::allows('isAdmin')){
            abort(404);
        }
        return view('admin.movies.edit', [
            'movie' => $movie
        ]);
    }

    public function update(MoviesRequest $request, Movie $movie)
    {
        if(!Gate::allows('isAdmin')){
            abort(404);
        }
        $validated = $request->validated();
        $movie->update($validated);
        return redirect()->route('admin.movies.show', $movie)->with('success', 'Film byl úspěšně upraven.');
    }

    public function destroy(Movie $movie)
    {
        if(!Gate::allows('isAdmin')){
            abort(404);
        }
        $movie->delete();
        return redirect()->route('admin.movies.index');
    }
}
