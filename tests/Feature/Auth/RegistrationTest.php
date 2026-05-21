<?php

use App\Models\User;
use App\UserRole;

it ('shows the register page', function () {
    $this->assertGuest()
        ->get('/register')
        ->assertOk();
});

it('creates new user', function () {
   $user = User::factory()->create([
       'name' => 'John Doe',
       'email' => 'john@kino.cz'
   ]);

   $this->assertDatabaseCount('users', 1);

   $this->assertDatabaseHas('users', [
       'name' => 'John Doe',
       'email' => 'john@kino.cz'
   ]);

   expect($user->name)->toBe('John Doe');
});

it('fails registration validation with invalid data', function ($field, $value, $errorKey) {
    $validData = [
        'name' => 'Jan Novák',
        'email' => 'jan@novak.cz',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ];

    $validData[$field] = $value;

    if ($field === 'password') {
        $validData['password_confirmation'] = $value;
    }

    $response = $this->post(route('register'), $validData);
    $response->assertSessionHasErrors([$errorKey]);
    $this->assertDatabaseCount('users', 0);
})->with([
    ['email', 'neplatny-email', 'email'],
    ['email', '', 'email'],
    ['name', '', 'name'],
    ['password', 'kratke', 'password'],
    ['password', '', 'password'],
]);

it('recognizes the admin and user', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN]);
    $user = User::factory()->create(['role' => UserRole::USER]);

    expect(Gate::forUser($admin)->allows('isAdmin'))->toBeTrue()
        ->and(Gate::forUser($user)->allows('isAdmin'))->toBeFalse();
});

it('protects admin routes from regular users', function () {
    $user = User::factory()->create(['role' => UserRole::USER]);

    $this->actingAs($user)
        ->get('/admin')
        ->assertStatus(404);
});

it('allows admin to access admin routes', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN]);

    $this->actingAs($admin)
        ->get('/admin')
        ->assertOk();
});
