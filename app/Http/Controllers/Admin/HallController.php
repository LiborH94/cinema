<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HallsRequest;
use App\Models\Hall;
use App\Models\Seat;
use App\SeatType;

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
        return redirect()->route('admin.halls.index')->with('success', 'Sál byl úspěšně vytvořen!');
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
    public function update(HallsRequest $request, Hall $hall)
    {
        $hall->update($request->only('name'));
        return redirect()->route('admin.halls.show', $hall)
        ->with('success', 'Sál a jeho rozložení bylo aktualizováno.');
        }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hall $hall)
    {
        $hall->delete();
        return redirect()->route('admin.halls.index');
    }
    public function toggleSeat(Seat $seat)
    {
        $new = match($seat->type) {
            SeatType::STANDARD => SeatType::VIP,
            SeatType::VIP      => SeatType::DISABLED,
            SeatType::DISABLED    => SeatType::STANDARD,
        };
        $seat->update(['type' => $new]);
        return back();
    }
}
