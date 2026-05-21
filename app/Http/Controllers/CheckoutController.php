<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\SeatType;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store ()
    {
        $user = auth()->user();
        $cartItems = $user->cartItems()
            ->with(['play', 'seat'])
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Košík je prázdný.');
        }

        DB::transaction(function () use ($user, $cartItems) {
            foreach ($cartItems as $item) {
                Ticket::create([
                    'user_id' => $user->id,
                    'play_id' => $item->play->id,
                    'seat_id' => $item->seat->id,
                    'price_paid' => $item->seat->type === SeatType::VIP
                        ? $item->play->vip_price
                        : $item->play->standard_price,
                ]);
            }
        });
        $user->cartItems()->delete();
        return redirect(route('public.tickets.index'))->with('success', 'Přejeme příjemný zážitek!');
    }
}
