<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movies;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        return view('admin.movies.index', [
            'movies' => Movies::all()
        ]);
    }
}
