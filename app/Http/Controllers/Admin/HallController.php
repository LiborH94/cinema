<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHallsRequest;
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
        if (!Gate::allows('isAdmin')) {
            abort(404);
        }

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
        if (!Gate::allows('isAdmin')) {
            abort(404);
        }
        return view('admin.halls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHallsRequest $request)
    {
        if (!Gate::allows('isAdmin')) {
            abort(404);
        }
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
        if (!Gate::allows('isAdmin')) {
            abort(404);
        }
        $seats = $hall->seats()
            ->orderBy('row', 'desc')
            ->orderBy('column')
            ->get()
            ->groupBy('row');
        return view('admin.halls.show', [
            'hall' => $hall,
            'rows' => $seats,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
    public function destroy(string $id)
    {
        //
    }
}
