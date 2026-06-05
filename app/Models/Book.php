<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Review;
use App\Models\Genre;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'author',
    'isbn',
    'published_at',
    'description',
    'image_url',
    'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function genres()
    {
        return $this->belongsToMany(
            Genre::class,
            'book_genre'
        );
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function favoritedUsers()
    {
        return $this->belongsToMany(
            User::class,
            'favorites'
        );
    }

}
