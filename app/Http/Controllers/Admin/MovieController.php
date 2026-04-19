<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMoviesRequest;
use App\Models\Movies;
use Illuminate\Support\Facades\Gate;

class MovieController extends Controller
{
    public function index()
    {
        if(!Gate::allows('isAdmin')){
            abort(404);
        }
        return view('admin.movies.index', [
            'movies' => Movies::all()
        ]);
    }
    public function create()
    {
        if(!Gate::allows('isAdmin')){
            abort(404);
        }
        return view('admin.movies.create');
    }
    public function store(StoreMoviesRequest $request) {

        if(!Gate::allows('isAdmin')){
            abort(404);
        }
        $validated = $request->validated();
        Movies::create($validated);
        return redirect()->route('admin.movies.index')->with('success', 'Film byl úspěšně přidán!');

    }
}
