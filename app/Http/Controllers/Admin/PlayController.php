<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaysRequest;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Play;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plays = Play::all();
        return view('admin.plays.index', [
            'plays' => $plays
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.plays.create', [
            'movies' => Movie::all(),
            'halls' => Hall::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlaysRequest $request)
    {
        $validated = $request->validated();
        Play::create($validated);
        return redirect()->route('admin.plays.index')->with('success', 'Představení bylo úspěšně vytvořeno!');
    }

    /**
     * Display the specified resource.
     */
    public function show (Play $play)
    {
        return view('admin.plays.show', [
            'play' => $play,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Play $play)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Play $play)
    {
        $play->delete();
        return redirect()->route('admin.plays.index')->with('success', 'Představení bylo úspěšně zrušeno.');
    }
}
