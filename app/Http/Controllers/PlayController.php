<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Models\CartItem;
use App\Models\Play;
use App\Traits\CalendarGenerator;
use Illuminate\Http\Request;


class PlayController extends Controller
{
    use CalendarGenerator;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedDate = $request->query('date', now()->toDateString());

        $plays = Play::query()
            ->whereDate('start_date', $selectedDate)
            ->with(['movie', 'hall'])
            ->orderBy('start_time')
            ->get();

        $days = $this->getCalendarDays($selectedDate);

        return view('public.index', [
            'plays' => $plays,
            'days' => $days,
            'selectedDate' => $selectedDate,
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show(Play $play)
    {
        $play->load(['hall.seats', 'tickets', 'cartItems']);

        $soldSeatsIds = $play->tickets->pluck('seat_id')->toArray();

        $myCartItems = $play->cartItems()
            ->where('user_id', auth()->id())
            ->with('seat')
            ->get();

        $totalCartPrice = $myCartItems->sum('price');

        $myCartSeatsIds = $myCartItems->pluck('seat_id')->toArray();

        $othersCartSeatsIds = $play->cartItems()
            ->where('user_id', '!=', auth()->id())
            ->pluck('seat_id')
            ->toArray();

        $rows = $play->hall->getSeatingPlan();

        return view('public.plays.show', [
            'play' => $play,
            'rows' => $rows,
            'soldSeatsIds' => $soldSeatsIds,
            'myCartSeatsIds' => $myCartSeatsIds,
            'othersCartSeatsIds' => $othersCartSeatsIds,
            'myCartItems' => $myCartItems,
            'totalCartPrice' => $totalCartPrice,
        ]);
    }
}
