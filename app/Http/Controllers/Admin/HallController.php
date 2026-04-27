<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallsRequest;
use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class HallController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $halls = Hall::all();

        return view('admin.halls.index', [
            'halls' => $halls,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.halls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HallsRequest $request)
    {
        $hall = Hall::create($request->validated());
        $seats = [];
        for ($i = 1; $i <= $request->rows_count; $i ++) {
            for ($j = 1; $j <= $request->columns_count; $j ++) {
                $seats[] = [
                    'hall_id' => $hall->id,
                    'row' => $i,
                    'column' => $j,
                ];
            }
        }
        Seat::insert($seats);
        return redirect()->route('admin.halls.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hall $hall)
    {
        return view('admin.halls.show', [
            'hall' => $hall,
            'rows' => $hall->getSeatingPlan(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hall $hall)
    {
        return view('admin.halls.edit', [
            'hall' => $hall,
            'rows' => $hall->getSeatingPlan(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HallsRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
