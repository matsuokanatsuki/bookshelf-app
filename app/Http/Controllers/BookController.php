<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('genres')
            ->withAvg('reviews', 'rating')
            ->latest()
            ->paginate(10);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        $genres = Genre::orderBy('name')->get();

        return view('books.create', compact('genres'));
    }

    public function store(StoreBookRequest $request)
    {
        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'published_at' => $request->published_at,
            'description' => $request->description,
            'image_url' => $request->image_url,
            'created_by' => Auth::id(),
        ]);

        $book->genres()->attach($request->genres);

        return redirect()
            ->route('books.index')
            ->with('success', '書籍を登録しました。');
    }

    public function show(Book $book)
    {
        $book->load('genres', 'creator');
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $genres = Genre::orderBy('name')->get();

        return view('books.edit', compact('book', 'genres'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'isbn' => $request->isbn,
            'published_at' => $request->published_at,
            'description' => $request->description,
            'image_url' => $request->image_url,
        ]);

        $book->genres()->sync($request->genres);

        return redirect()
            ->route('books.show', $book)
            ->with('success', '書籍を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
