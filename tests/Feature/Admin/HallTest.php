<?php

use App\Models\Hall;
use App\Models\Seat;
use App\Models\User;
use App\SeatType;
use App\UserRole;

it('denies non admin users and guests from accessing admin hall index', function () {
    $this->assertGuest()
        ->get(route('admin.halls.index'))
        ->assertStatus(404);

    $user = User::factory()->create(['role' => UserRole::USER->value]);

    $this->actingAs($user)
        ->get(route('admin.halls.index'))
        ->assertStatus(404);
});

it('allows admin to see halls index and create a new hall', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);

    $this->actingAs($admin)
        ->get(route('admin.halls.index'))
        ->assertOk();

    $hallData = [
        'name' => 'Velký sál IMAX',
        'rows_count' => 8,
        'columns_count' => 8,
    ];

    $response = $this->actingAs($admin)
        ->post(route('admin.halls.store'), $hallData);

    $response->assertRedirect(route('admin.halls.index'));
    $this->assertDatabaseHas('halls', $hallData);
});

it('allows admin to delete a hall', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $hall = Hall::factory()->create(['name' => 'Sál ke smazání']);

    $response = $this->actingAs($admin)
        ->delete(route('admin.halls.destroy', $hall));

    $response->assertRedirect(route('admin.halls.index'));
    $this->assertDatabaseMissing('halls', ['id' => $hall->id]);
});

it('allows admin to toggle a seat status', function () {
    $admin = User::factory()->create(['role' => UserRole::ADMIN->value]);
    $hall = Hall::factory()->create();
    $seat = $hall->seats->first();

    $seat->update(['type' => SeatType::STANDARD->value]);

    $response = $this->actingAs($admin)
        ->from(route('admin.halls.show', $hall))
        ->patch(route('admin.seats.toggle', $seat));

    $response->assertRedirect(route('admin.halls.show', $hall));

    $this->assertDatabaseHas('seats', [
        'id' => $seat->id,
        'type' => SeatType::VIP->value,
    ]);
});

it('denies non admin users from managing halls and seats', function () {
    $user = User::factory()->create(['role' => UserRole::USER->value]);
    $hall = Hall::factory()->create();
    $seat = $hall->seats->first();


    $this->actingAs($user)->get(route('admin.halls.index'))->assertStatus(404);

    $this->actingAs($user)->delete(route('admin.halls.destroy', $hall))->assertStatus(404);

    $this->actingAs($user)->patch(route('admin.seats.toggle', $seat))->assertStatus(404);
});
