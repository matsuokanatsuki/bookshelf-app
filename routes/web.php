<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\LikeController;


Route::get('/', function () {
    return redirect()->route('login');
});

// Route::resource('books', BookController::class)
//     ->only(['index', 'show']);

Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
        // ->except(['index', 'show']);
    Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::post('/reviews/{review}/like', [LikeController::class, 'toggle'])->name('reviews.like');
    Route::post('/books/{book}/favorite',[FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites',[FavoriteController::class, 'index'])->name('favorites.index');
});

Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
Route::get('/genres', fn() => view('genres'))->name('genres.index');