<?php

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Play;
use App\Models\User;
use App\UserRole;

it('denies non admin users and guests from accessing admin play index', function () {
    $this->assertGuest()
        ->get(route('admin.plays.index'))
        ->assertStatus(404);

    $user = User::factory()->create(['role' => UserRole::USER->value]);

    $this->actingAs($user)
        ->get(route('admin.plays.index'))
        ->assertStatus(404);
});

it('denies guests and non admin users from storing a play', function () {
    $movie = Movie::factory()->create();
    $hall = Hall::factory()->create();

    $playData = [
        'movie_id' => $movie->id,
        'hall_id' => $hall->id,
        'start_date' => '2026-06-01',
        'start_time' => '20:00',
        'standard_price' => 180,
        'vip_price' => 250,
    ];

    $this->post(route('admin.plays.store'), $playData)
        ->assertStatus(404);

    $user = User::factory()->create(['role' => UserRole::USER->value]);

    $this->actingAs($user)
        ->post(route('admin.plays.store'), $playData)
        ->assertStatus(404);

    $this->assertDatabaseMissing('plays', $playData);
});

it('denies guests and non admin users from deleting a play', function () {
    $play = Play::factory()->create();

    $this->delete(route('admin.plays.destroy', $play))
        ->assertStatus(404);

    $user = User::factory()->create(['role' => UserRole::USER->value]);

    $this->actingAs($user)
        ->delete(route('admin.plays.destroy', $play))
        ->assertStatus(404);

    $this->assertDatabaseHas('plays', ['id' => $play->id]);
});

it('allows admin to store a new play', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    $movie = Movie::factory()->create();
    $hall = Hall::factory()->create();

    $playData = [
        'movie_id' => $movie->id,
        'hall_id' => $hall->id,
        'start_date' => '2026-06-01 00:00:00',
        'start_time' => '20:00',
        'standard_price' => 180,
        'vip_price' => 250,
    ];

    $response = $this->actingAs($admin)
        ->post(route('admin.plays.store'), $playData);

    $response->assertRedirect(route('admin.plays.index'));

    $this->assertDatabaseHas('plays', $playData);
});

it('allows admin to delete a play', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    $play = Play::factory()->create();

    $response = $this->actingAs($admin)
        ->delete(route('admin.plays.destroy', $play));

    $response->assertRedirect(route('admin.plays.index'));

    $this->assertDatabaseMissing('plays', ['id' => $play->id]);
});
