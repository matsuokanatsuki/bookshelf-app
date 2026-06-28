<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Requests\Api\ApiStoreBookRequest;
use App\Http\Requests\Api\ApiUpdateBookRequest;
use App\Models\Book;
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
    public function store(ApiStoreBookRequest $request)
    {
        $validatedData = $request->validated();

        $book = Book::create([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'isbn' => $validatedData['isbn'] ?? null,
            'published_at' => $validatedData['published_at'] ?? null,
            'description' => $validatedData['description'] ?? null,
            'image_url' => $validatedData['image_url'] ?? null,
            'created_by' => $validatedData['created_by'],
        ]);

        if (isset($validatedData['genres'])) {
            $book->genres()->attach($validatedData['genres']);
        }

        $book->load('genres');

        return response()->json([
            'message' => '書籍を登録しました。',
            'data' => new BookResource($book),
        ],201);
    }

    /**
     * 書籍情報更新
     */
    public function update(ApiUpdateBookRequest $request, Book $book)
    {
        if ($request->user()->cannot('update', $book)) {
            return response()->json(['message' => 'この書籍を更新する権限がありません。'], 403);
        }

        $validatedData = $request->validated();

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
        $book->load('genres');

        return response()->json([
            'message' => '書籍情報を更新しました。',
            'data' => new BookResource($book),
        ], 200);
    }

    /**
     * 書籍情報削除
     */
    public function destroy(Book $book)
    {
        if (request()->user()->cannot('delete', $book)) {
            return response()->json(['message' => 'この書籍を削除する権限がありません。'], 403);
        }

        $book->delete();

        return response()->noContent();
    }
}
