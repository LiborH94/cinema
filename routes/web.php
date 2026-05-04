<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HallController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\Admin\PlayController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::view('/', 'index')->name('home');

// register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register')->middleware('guest');
// login
Route::get('/login', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->name('login')->middleware('guest');
// logout
Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth');
// schedule
Route::get('/schedule', [MovieController::class, 'index'])->name('schedule');
// admin
Route::middleware([AdminMiddleware::class])
    ->prefix('admin')
    ->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    // halls
    Route::get('/halls', [HallController::class, 'index'])->name('admin.halls.index');
    Route::get('/halls/create', [HallController::class, 'create'])->name('admin.halls.create');
    Route::post('/halls', [HallController::class, 'store'])->name('admin.halls.store');
    Route::get('/halls/{hall}', [HallController::class, 'show'])->name('admin.halls.show');
    Route::get('/halls/{hall}/edit', [HallController::class, 'edit'])->name('admin.halls.edit');
    Route::patch('/halls/{hall}', [HallController::class, 'update'])->name('admin.halls.update');
    Route::delete('/halls/{hall}', [HallController::class, 'destroy'])->name('admin.halls.destroy');
    // seats
    Route::patch('/seats/{seat}/toogle', [HallController::class, 'toggleSeat'])->name('admin.seats.toggle');
    // movies
    Route::get('/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');
    Route::get('/movies/create', [AdminMovieController::class, 'create'])->name('admin.movies.create');
    Route::post('/movies', [AdminMovieController::class, 'store'])->name('admin.movies.store');
    Route::get('/movies/{movie}', [AdminMovieController::class, 'show'])->name('admin.movies.show');
    Route::get('/movies/{movie}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');
    Route::patch('/movies/{movie}', [AdminMovieController::class, 'update'])->name('admin.movies.update');
    Route::delete('/movies/{movie}', [AdminMovieController::class, 'destroy'])->name('admin.movies.destroy');
    // plays
    Route::get('/plays', [PlayController::class, 'index'])->name('admin.plays.index');
    Route::get('/plays/create', [PlayController::class, 'create'])->name('admin.plays.create');
    Route::post('/plays', [PlayController::class, 'store'])->name('admin.plays.store');
    Route::get('/plays/{play}', [PlayController::class, 'show'])->name('admin.plays.show');
    Route::get('/plays/{play}/edit', [PlayController::class, 'edit'])->name('admin.plays.edit');
    Route::patch('/plays/{play}', [PlayController::class, 'update'])->name('admin.plays.update');
    Route::delete('/plays/{play}', [PlayController::class, 'destroy'])->name('admin.plays.destroy');
});

