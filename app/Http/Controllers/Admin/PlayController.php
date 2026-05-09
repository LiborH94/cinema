<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlaysRequest;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Play;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedDate = $request->query('date', now()->toDateString());

        $plays = Play::query()
            ->where('start_date', 'like', $selectedDate . '%')
            ->with(['movie', 'hall'])
            ->orderBy('start_time')
            ->get();

        $days = collect(range(0, 14))->map(function ($day) use ($selectedDate) {
            $date = now()->copy()->addDays($day);

            return [
                'date' => $date,
                'formatted' => $date->toDateString(),
                'active' => $selectedDate === $date->toDateString(),
            ];
        });

        return view('admin.plays.index', [
            'plays' => $plays,
            'days' => $days,
            'selectedDate' => $selectedDate,
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
     * Remove the specified resource from storage.
     */
    public function destroy(Play $play)
    {
        $play->delete();
        return redirect()->route('admin.plays.index')->with('success', 'Představení bylo úspěšně zrušeno.');
    }
}
