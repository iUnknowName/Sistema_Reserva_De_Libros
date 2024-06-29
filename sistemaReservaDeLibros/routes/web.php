<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('reservations', ReservationController::class)
    ->only(['index', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('books', BooksController::class)
    ->only(['index'])
    ->middleware(['auth', 'verified']);


Route::post('books/{book}/reserve', [BooksController::class, 'reserve'])
    ->name('books.reserve')
    ->middleware(['auth', 'verified']);

require __DIR__ . '/auth.php';
