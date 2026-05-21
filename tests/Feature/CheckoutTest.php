<?php

use App\Models\CartItem;
use App\Models\Play;
use App\Models\User;


it('successfully purchases tickets and clears the cart', function () {
    $user = User::factory()->create();
    $play = Play::factory()->create(['standard_price' => 150]);

    $seat = $play->hall->seats()->first();

    CartItem::factory()->create([
        'user_id' => $user->id,
        'play_id' => $play->id,
        'seat_id' => $seat->id,
    ]);

    $this->assertDatabaseCount('cart_items', 1);
    $this->assertDatabaseCount('tickets', 0);

    $response = $this->actingAs($user)
        ->post(route('public.checkout'));

    $response->assertRedirect(route('public.tickets.index'));

    $this->assertDatabaseCount('cart_items', 0);

    $this->assertDatabaseHas('tickets', [
        'user_id' => $user->id,
        'play_id' => $play->id,
        'seat_id' => $seat->id,
        'price_paid' => 150,
    ]);
});

it('prevents checkout if the cart is empty', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('public.checkout'));

    $this->assertDatabaseCount('tickets', 0);
});

it('shows empty cart message and hides checkout button', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('public.cart'))
        ->assertOk()
        ->assertSee('Váš košík je momentálně prázdný.')
        ->assertDontSee('Zaplatit a stáhnout vstupenky');
});
