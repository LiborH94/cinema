<?php

use App\Models\Movie;
use App\Models\User;
use App\UserRole;

it('denies non admin users and guests from accessing admin movie index', function () {
    $this->assertGuest()
        ->get(route('admin.movies.index'))
        ->assertStatus(404);

    $user = User::factory()->create(['role' => UserRole::USER->value]);

    $this->actingAs($user)
        ->get(route('admin.movies.index'))
        ->assertStatus(404);
});

it('denies guests and regular users from creating a new movie', function () {
    $movieData = [
        'name' => 'NonAdmin',
        'description' => 'Pokus o neoprávněný zápis',
    ];

    $this->post(route('admin.movies.store'), $movieData)
        ->assertStatus(404);

    $user = User::factory()->create(['role' => UserRole::USER->value]);
    $this->actingAs($user)
        ->post(route('admin.movies.store'), $movieData)
        ->assertStatus(404);

    $this->assertDatabaseMissing('movies', ['name' => 'NonAdmin']);
});

it('allows admin to see admin movie index', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    $this->actingAs($admin)
        ->get(route('admin.movies.index'))
        ->assertOk();
});

it('allows admin to create a new movie', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    $movieData = [
        'name' => 'Pelíšky',
        'description' => 'Česká klasika',
    ];

    $response = $this->actingAs($admin)
        ->post(route('admin.movies.store'), $movieData);

    $response->assertRedirect(route('admin.movies.index'));

    $this->assertDatabaseHas('movies', [
        'name' => 'Pelíšky',
        'description' => 'Česká klasika',
    ]);
});

it('allows admin to edit a movie', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $movie = Movie::factory()->create([
        'name' => 'Spiderman',
        'description' => 'Spiderman první díl',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.movies.edit', $movie))
        ->assertOk();
    $updatedData = [
        'name' => 'Spiderman 2',
        'description' => 'Spiderman druhý díl',
    ];

    $response = $this->actingAs($admin)
        ->patch(route('admin.movies.update', $movie), $updatedData);

    $response->assertRedirect(route('admin.movies.show', $movie));

    $this->assertDatabaseHas('movies', $updatedData);
    $this->assertDatabaseMissing('movies', [
        'name' => 'Spiderman',
    ]);
});

it('denies guests and regular users from updating a movie', function () {
    $movie = Movie::factory()->create([
        'name' => 'Film',
        'description' => 'Popisek',
    ]);

    $newData = ['name' => 'Změněný název'];

    $this->patch(route('admin.movies.update', $movie), $newData)
        ->assertStatus(404);

    $user = User::factory()->create(['role' => UserRole::USER->value]);
    $this->actingAs($user)
        ->patch(route('admin.movies.update', $movie), $newData)
        ->assertStatus(404);

    $this->assertDatabaseHas('movies', ['id' => $movie->id, 'name' => 'Film']);
});

it('allows admin to delete a movie', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    $movie = Movie::factory()->create([
        'name' => 'Film ke smazání',
    ]);

    $this->assertDatabaseHas('movies', ['id' => $movie->id]);

    $response = $this->actingAs($admin)
        ->delete(route('admin.movies.destroy', $movie));

    $response->assertRedirect(route('admin.movies.index'));

    $this->assertDatabaseMissing('movies', ['id' => $movie->id]);
});

it('denies guests and regular users from deleting a movie', function () {
    $movie = Movie::factory()->create(['name' => 'Film']);

    $this->delete(route('admin.movies.destroy', $movie))
        ->assertStatus(404);

    $user = User::factory()->create(['role' => UserRole::USER->value]);
    $this->actingAs($user)
        ->delete(route('admin.movies.destroy', $movie))
        ->assertStatus(404);

    $this->assertDatabaseHas('movies', ['id' => $movie->id]);
});
