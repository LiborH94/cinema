<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartItemRequest;
use App\Models\CartItem;
use App\Models\Play;
use App\Models\Seat;
use App\SeatType;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function index()
    {
        $cartItems = \App\Models\CartItem::where('user_id', auth()->id())
            ->with(['play.movie', 'seat'])
            ->get();

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->seat->type === \App\SeatType::VIP
                ? $item->play->vip_price
                : $item->play->standard_price;
        });

        return view('cart.index', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice
        ]);
    }
    public function addToCart(CartItemRequest $request, Play $play)
    {

        $seatId = $request->validated(['seat_id']);
        $seat = Seat::findOrFail($seatId);

        if ($seat->type === SeatType::DISABLED) {
            return back()->with('error', 'Omlouváme se, toto sedadlo je mimo provoz.');
        }

        if ($seat->hall_id !== $play->hall_id) {
            return back()->with('error', 'Chyba: Sedadlo nepatří k tomuto představení.');
        }

        $alreadyTaken = CartItem::where('play_id', $play->id)
            ->where('seat_id', $seat->id)
            ->exists();

        if ($alreadyTaken) {
            return back()->with('error', 'Toto sedadlo už je rezervované.');
        }

        CartItem::create([
            'user_id' => auth()->id(),
            'play_id' => $play->id,
            'seat_id' => $seat->id,
        ]);

        return back()->with('success', 'Sedadlo je v košíku!');
    }

    public function removeFromCart(Request $request, Play $play)
    {
        $seatId = $request->input('seat_id');
        $cartItem = CartItem::where('play_id', $play->id)
            ->where('seat_id', $seatId)
            ->where('user_id', auth()->id())
            ->first();
        if ($cartItem) {
            $cartItem->delete();
            return back()->with('success', 'Sedadlo bylo odstraněno z košíku.');
        }

        return back()->with('error', 'Sedadlo se nepodařilo v košíku najít.');
    }

    public function totalPrice(Play $play): int
    {
        $items = CartItem::where('play_id', $play->id)
            ->where('user_id', auth()->id())
            ->with('seat')
            ->get();

        return $items->sum(function ($item) {
            if ($item->seat->type === SeatType::VIP) {
                return $item->seat->price_vip;
            }
            return $item->seat->price;
        });
    }
}
