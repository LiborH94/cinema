<?php

namespace Database\Seeders;

use App\Models\User;
use App\UserRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 10; $i++){
            User::factory()->create();
        }
        User::updateOrCreate(
            ['email' => 'admin@cinema.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => UserRole::ADMIN->value,
            ]
        );
        User::UpdateOrCreate(
            ['email' => 'user@cinema.test'],
            [
                'name' => 'User',
                'password' => Hash::make('password'),
                'role' => UserRole::USER->value,
            ]
        );
    }

}
