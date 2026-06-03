<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
});

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::get('/review', fn() => view('review'))->name('review.index');
Route::get('/ranking', fn() => view('ranking'))->name('ranking.index');
Route::get('/favorites', fn() => view('favorites'))->name('favorites.index');
Route::get('/genres', fn() => view('genres'))->name('genres.index');