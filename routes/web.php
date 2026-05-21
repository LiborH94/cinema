<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HallController;
use App\Http\Controllers\Admin\MovieController as AdminMovieController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\Admin\PlayController as AdminPlayController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CheckProfileAccess;
use Illuminate\Support\Facades\Route;

Route::get('/', [PlayController::class, 'index'])->name('home');
// register
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register')->middleware('guest');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register')->middleware('guest');
// login
Route::post('/database/init-seed', [SessionController::class, 'initSeed'])->name('database.init');
Route::get('/login', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->name('login')->middleware('guest');
// user management
Route::middleware([CheckProfileAccess::class])
    ->prefix('profile')
    ->group(function () {
    Route::get('/profile/{user}', [RegisteredUserController::class, 'show'])->name('profile.show')->middleware('auth');
    Route::get('/profile/{user}/edit', [RegisteredUserController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{user}', [RegisteredUserController::class, 'update'])->name('profile.update');
});

// logout
Route::delete('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth');
// cart
Route::get('/cart', [CartItemController::class, 'index'])->name('public.cart')->middleware('auth');
// cartItems
Route::post('/plays/{play}', [CartItemController::class, 'addToCart'])->name('cart.add')->middleware('auth');
Route::delete('/plays/{play}/remove-seat', [CartItemController::class, 'removeFromCart'])->name('cart.remove');
// tickets
Route::get('/tickets', [TicketController::class, 'index'])->name('public.tickets.index')->middleware('auth');
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('public.tickets.show')->middleware('auth');
Route::get('/tickets/{ticket}/download', [TicketController::class, 'downloadOne'])
    ->name('public.tickets.downloadOne')
    ->middleware('auth');
Route::get('/tickets/play/{play}/download', [TicketController::class, 'downloadAllForPlay'])
    ->name('public.tickets.download_play')
    ->middleware('auth');
// checkout
Route::post('/tickets', [CheckoutController::class, 'store'])->name('public.checkout')->middleware('auth');
// plays
Route::get('/plays/{play}', [PlayController::class, 'show'])->name('public.plays.show');
// movies
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('public.movies.show');
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
    Route::get('/plays', [AdminPlayController::class, 'index'])->name('admin.plays.index');
    Route::get('/plays/create', [AdminPlayController::class, 'create'])->name('admin.plays.create');
    Route::post('/plays', [AdminPlayController::class, 'store'])->name('admin.plays.store');
    Route::get('/plays/{play}', [AdminPlayController::class, 'show'])->name('admin.plays.show');
    Route::delete('/plays/{play}', [AdminPlayController::class, 'destroy'])->name('admin.plays.destroy');
});

