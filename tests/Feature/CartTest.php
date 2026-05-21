<?php

use App\Models\CartItem;
use App\Models\Movie;
use App\Models\Play;
use App\Models\User;
use App\SeatType;

it('redirects guests to login page when trying to view cart', function () {
    $this->get(route('public.cart'))
        ->assertRedirect(route('login'));
});

it('shows the cart page to an authenticated user', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('public.cart'))
        ->assertOk();
});

it('shows an empty cart message when no items are added', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('public.cart'))
        ->assertOk()
        ->assertSee('Váš košík je momentálně prázdný.')
        ->assertDontSee('Zaplatit');
});

it('displays standard ticket price for standard seat', function () {
    $user = User::factory()->create();
    $movie = Movie::factory()->create(['name' => 'Spider-man']);

    $play = Play::factory()->create([
        'movie_id' => $movie->id,
        'standard_price' => 150,
        'vip_price' => 250,
    ]);

    $seat = $play->hall->seats()->where('type', SeatType::STANDARD->value)->first();

    CartItem::factory()->create([
        'user_id' => $user->id,
        'play_id' => $play->id,
        'seat_id' => $seat->id,
    ]);

    $this->actingAs($user)
        ->get(route('public.cart'))
        ->assertOk()
        ->assertSee('Spider-man')
        ->assertSee('150')
        ->assertDontSee('250');
});

it('displays vip ticket price for vip seat', function () {
    $user = User::factory()->create();
    $movie = Movie::factory()->create(['name' => 'Spider-man']);

    $play = Play::factory()->create([
        'movie_id' => $movie->id,
        'standard_price' => 150,
        'vip_price' => 250,
    ]);

    $seat = $play->hall->seats()->where('type', SeatType::VIP->value)->first();

    CartItem::factory()->create([
        'user_id' => $user->id,
        'play_id' => $play->id,
        'seat_id' => $seat->id,
    ]);

    $this->actingAs($user)
        ->get(route('public.cart'))
        ->assertOk()
        ->assertSee('Spider-man')
        ->assertSee('250')
        ->assertDontSee('150');
});

it('allows user to remove an item from the cart', function () {
    $user = User::factory()->create();

    $play = Play::factory()->create();
    $seat = $play->hall->seats()->first();

    CartItem::factory()->create([
        'user_id' => $user->id,
        'play_id' => $play->id,
        'seat_id' => $seat->id,
    ]);

    $this->assertDatabaseCount('cart_items', 1);

    $response = $this->actingAs($user)
        ->delete(route('cart.remove', $play), [
            'seat_id' => $seat->id
        ]);
    $response->assertRedirect();
    $response->assertSessionHas('success', 'Sedadlo bylo odstraněno z košíku.');

    $this->assertDatabaseCount('cart_items', 0);
});
