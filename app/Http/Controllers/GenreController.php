<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('books')->orderBy('name')->paginate(10);
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(StoreGenreRequest $request)
    {
        Genre::create([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('genres.index')
            ->with('success', 'ジャンルを登録しました。');
    }

    public function show(Genre $genre)
    {
        $books = $genre->books()->with('genres')->paginate(10);
        return view('genres.show', compact('genre', 'books'));
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        $genre->update([
            'name' => $request->name,
        ]);

        return redirect()
            ->route('genres.index')
            ->with('success', 'ジャンルを更新しました。');
    }

    public function destroy(Genre $genre)
    {
        if ($genre->books()->exists()) {
            return back()
                ->with('error', 'このジャンルは書籍に関連付けられているため、削除できません。');
        }
        $genre->delete();

        return redirect()
            ->route('genres.index')
            ->with('success', 'ジャンルを削除しました。');
    }
}
