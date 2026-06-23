<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Genre;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BookController extends Controller
{
    /**
     * 一覧取得
     */
    public function index() : AnonymousResourceCollection
    {
        $books = Book::with('genres')->withAvg('reviews', 'rating')->latest()->paginate(10);
        return BookResource::collection($books);
    }

    /**
     * 書籍詳細取得
     */
    public function show(Book $book) : BookResource
    {
        $book->load('genres', 'creator', 'reviews.user', 'reviews.likedByUsers');
        return new BookResource($book);
    }

    /**
     * 書籍登録
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|regex:/^[0-9]{13}$/|unique:books,isbn',
            'published_at' => 'nullable|date',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url|max:255',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book = Book::create([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'isbn' => $validatedData['isbn'] ?? null,
            'published_at' => $validatedData['published_at'] ?? null,
            'description' => $validatedData['description'] ?? null,
            'image_url' => $validatedData['image_url'] ?? null,
            'created_by' => auth()->id(),
        ]);

        if (isset($validatedData['genres'])) {
            $book->genres()->attach($validatedData['genres']);
        }

        return new BookResource($book);
    }

    /**
     * 書籍情報更新
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|regex:/^[0-9]{13}$/|unique:books,isbn,' . $book->id,
            'published_at' => 'nullable|date',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url|max:255',
            'genres' => 'array',
            'genres.*' => 'exists:genres,id',
        ]);

        $book->update([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'isbn' => $validatedData['isbn'] ?? null,
            'published_at' => $validatedData['published_at'] ?? null,
            'description' => $validatedData['description'] ?? null,
            'image_url' => $validatedData['image_url'] ?? null,
        ]);

        if (isset($validatedData['genres'])) {
            $book->genres()->sync($validatedData['genres']);
        }

        return new BookResource($book);
    }

    /**
     * 書籍情報削除
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->noContent();
    }
}
