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
    // movies
    Route::get('/movies', [AdminMovieController::class, 'index'])->name('admin.movies.index');
    Route::get('/movies/create', [AdminMovieController::class, 'create'])->name('admin.movies.create');
    Route::post('/movies', [AdminMovieController::class, 'store'])->name('admin.movies.store');
    Route::get('/movies/{movie}', [AdminMovieController::class, 'show'])->name('admin.movies.show');
    Route::get('/movies/{movie}/edit', [AdminMovieController::class, 'edit'])->name('admin.movies.edit');
    Route::patch('/movies/{movie}', [AdminMovieController::class, 'update'])->name('admin.movies.update');
    Route::delete('/movies/{movie}', [AdminMovieController::class, 'destroy'])->name('admin.movies.delete');
    // plays
    Route::get('/plays', [PlayController::class, 'index'])->name('admin.plays.index');
});

