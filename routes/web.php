<?php

use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'index')->name('home');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
