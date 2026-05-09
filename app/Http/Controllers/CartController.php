<?php

namespace App\Http\Controllers;

use App\CartStatus;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Play;
use App\Models\Seat;
use App\SeatType;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Add a selected seat for a specific play to the user's active cart.
     */
    public function addToCart(Request $request, Play $play, Seat $seat)
    {
        if ($seat->type === SeatType::DISABLED) {
            return back()->with('error', 'Omlouváme se, toto sedadlo je mimo provoz.');
        }
        if ($seat->hall_id !== $play->hall_id) {
            return back()->with('error', 'Chyba: Sedadlo nepatří k tomuto představení.');
        }
        $cart = Cart::firstOrCreate(
            [
                'user_id' => auth()->id(),
                'status' => CartStatus::ACTIVE->value,
            ]
        );
        $alreadyTaken = CartItem::where('play_id', $play->id)
            ->where('seat_id', $seat->id)
            ->exists();
        if ($alreadyTaken) {
            return back()->with('error', 'Toto sedadlo už je rezervované v jiném košíku.');
        }

        $cart->items()->create([
            'play_id' => $play->id,
            'seat_id' => $seat->id,
        ]);

        return back()->with('success', 'Sedadlo je v košíku!');
    }
    public function index (Cart $cart)
    {
        return view('cart.show', [
            'cart' => $cart,
        ]);
    }
    public function removeFromCart(Request $request, Play $play, Seat $seat)
    {

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
