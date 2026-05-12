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

        $plays = Play::where('start_date', '<=', now()->toDateString())
            ->where(function($query) {
                $query->where('start_date', '>=', now()->toDateString())
                    ->orWhere('start_time', '>=', now()->toTimeString());
            })
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
    public function showPlayDetails(Play $play)
    {
        $play->load(['movie', 'hall']);
        return view('public.plays.showPlayDetails', [
            'play' => $play,
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function showPlayToOrderTickets(Play $play)
    {
        $play->load(['hall.seats', 'tickets', 'cartItems']);

        $soldSeatsIds = $play->tickets->pluck('seat_id')->toArray();

        $myCartItems = $play->cartItems()
            ->where('user_id', auth()->id())
            ->with('seat')
            ->get();
        $myCartSeatsIds = $myCartItems->pluck('seat_id')->toArray();

        $othersCartSeatsIds = $play->cartItems()
            ->where('user_id', '!=', auth()->id())
            ->pluck('seat_id')
            ->toArray();

        $rows = $play->hall->seats->groupBy('row');

        return view('public.plays.showPlayToOrderTickets', [
            'play' => $play,
            'rows' => $rows,
            'soldSeatsIds' => $soldSeatsIds,
            'myCartSeatsIds' => $myCartSeatsIds,
            'othersCartSeatsIds' => $othersCartSeatsIds,
            'myCartItems' => $myCartItems,
        ]);
    }

    public function addSeatToCart(CartItemRequest $request, Play $play)
    {
        $validated = $request->validated();


        CartItem::create([
            'user_id' => auth()->id(),
            'play_id' => $play->id,
            'seat_id' => $validated['seat_id'],
        ]);

        return back()->with('success', 'Sedadlo přidáno do košíku.');
    }
}
