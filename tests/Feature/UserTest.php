<?php

use App\Models\User;
use App\UserRole;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;

it('create new user', function () {
   $user = User::factory()->create([
       'name' => 'John Doe',
       'email' => 'john@kino.cz'
   ]);

   assertDatabaseCount('users', 1);

   assertDatabaseHas('users', [
       'name' => 'John Doe',
       'email' => 'john@kino.cz'
   ]);

   expect($user->name)->toBe('John Doe');
});

it('recognizes the admin and user', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $user = User::factory()->create(['role' => UserRole::USER->value]);

    expect(Gate::forUser($admin)->allows('isAdmin'))->toBeTrue()
        ->and(Gate::forUser($user)->allows('isAdmin'))->toBeFalse();
});

it('protects admin routes from regular users', function () {
    $user = User::factory()->create(['role' => UserRole::USER]);

    $this->actingAs($user)
        ->get('/admin/plays')
        ->assertStatus(404);
});

it('allows admins to access admin routes', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN]);

    $this->actingAs($admin)
        ->get('/admin/plays')
        ->assertOk();
});
