<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MovieController extends Controller
{
    public function show(Movie $movie)
    {
        $movie->load(['plays.hall']);

        return view('public.movies.show', [
            'movie' => $movie,
        ]);
    }
}
