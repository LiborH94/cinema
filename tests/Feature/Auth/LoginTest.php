<?php

use App\Models\User;

it('shows the login page', function () {
    $this->get(route('login'))
        ->assertOk();
});

it('logs in a user with correct credentials', function () {
    $user = User::factory()->create([
        'email' => 'test@kino.cz',
        'password' => Hash::make('password123'),
    ]);
    $response = $this->post(route('login'), [
        'email' => 'test@kino.cz',
        'password' => 'password123',
    ]);
    $response->assertRedirect(route('home'));
    $this->assertAuthenticatedAs($user);
});

it('fails login with incorrect password', function () {
    User::factory()->create([
        'email' => 'test@kino.cz',
        'password' => Hash::make('password123'),
    ]);
    $response = $this->post(route('login'), [
        'email' => 'test@kino.cz',
        'password' => 'SpatneHeslo',
    ]);
    $response->assertSessionHasErrors(['email']);
    $this->assertGuest();
});

it('fails login with non-existent email', function () {
    $response = $this->post(route('login'), [
        'email' => 'unexist@kino.cz',
        'password' => 'password123',
    ]);
    $response->assertSessionHasErrors(['email']);
    $this->assertGuest();
});

it('logs out an authenticated user', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)
        ->delete(route('logout'));
    $response->assertRedirect(route('home'));
    $this->assertGuest();
});
