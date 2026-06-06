<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::resource('books', BookController::class)
//     ->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
        // ->except(['index', 'show']);
});

Route::middleware('auth')->group(function () {
    Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    // Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::get('/ranking', fn() => view('ranking'))->name('ranking.index');
Route::get('/favorites', fn() => view('favorites'))->name('favorites.index');
Route::get('/genres', fn() => view('genres'))->name('genres.index');