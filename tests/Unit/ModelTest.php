<?php

namespace Tests\Unit;

use App\Models\Book;
use App\Models\Genre;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    /**
     * A basic unit test example.
     */
//    /** @test */
//     public function a_book_can_have_multiple_genres()
//     {
//         $book = new \App\Models\Book();
//         $genre1 = new \App\Models\Genre(['name' => 'Fiction']);
//         $genre2 = new \App\Models\Genre(['name' => 'Science']);
//         $book->genres()->saveMany([$genre1, $genre2]);
//         $this->assertCount(2, $book->genres);
//     }

//     /** @test */
//     public function a_genre_can_have_multiple_books()
//     {
//         $genre = new \App\Models\Genre();
//         $book1 = new \App\Models\Book(['title' => 'Book 1']);
//         $book2 = new \App\Models\Book(['title' => 'Book 2']);
//         $genre->books()->saveMany([$book1, $book2]);
//         $this->assertCount(2, $genre->books);
//     }

//     /** @test */
//     public function a_book_can_have_multiple_reviews()
//     {
//         $book = new \App\Models\Book();
//         $review1 = new \App\Models\Review(['content' => 'Great book!']);
//         $review2 = new \App\Models\Review(['content' => 'Not bad.']);
//         $book->reviews()->saveMany([$review1, $review2]);
//         $this->assertCount(2, $book->reviews);
//     }

//     /** @test */
//     public function a_book_can_be_favorited_by_multiple_users()
//     {
//         $book = new \App\Models\Book();
//         $user1 = new \App\Models\User(['name' => 'User 1']);
//         $user2 = new \App\Models\User(['name' => 'User 2']);
//         $book->favoritedUsers()->saveMany([$user1, $user2]);
//         $this->assertCount(2, $book->favoritedUsers);
//     }

//     /** @test */
//     public function a_user_can_favorite_multiple_books()
//     {
//         $user = new \App\Models\User();
//         $book1 = new \App\Models\Book(['title' => 'Book 1']);
//         $book2 = new \App\Models\Book(['title' => 'Book 2']);
//         $user->favoriteBooks()->saveMany([$book1, $book2]);
//         $this->assertCount(2, $user->favoriteBooks);
//     }

//     /** @test */
//     public function a_book_belongs_to_a_creator()
//     {
//         $user = new \App\Models\User(['name' => 'Creator']);
//         $book = new \App\Models\Book(['title' => 'Book Title']);
//         $book->creator()->associate($user);
//         $this->assertEquals('Creator', $book->creator->name);
//     }

//     /** @test */
//     public function a_review_belongs_to_a_user()
//     {
//         $user = new \App\Models\User(['name' => 'Reviewer']);
//         $review = new \App\Models\Review(['content' => 'Great book!']);
//         $review->user()->associate($user);
//         $this->assertEquals('Reviewer', $review->user->name);
//     }

//     /** @test */
//     public function a_review_belongs_to_a_book()
//     {
//         $book = new \App\Models\Book(['title' => 'Book Title']);
//         $review = new \App\Models\Review(['content' => 'Great book!']);
//         $review->book()->associate($book);
//         $this->assertEquals('Book Title', $review->book->title);
//     }

//     /** @test */
//     public function a_favorite_belongs_to_a_user()
//     {
//         $user = new \App\Models\User(['name' => 'User']);
//         $favorite = new \App\Models\Favorite();
//         $favorite->user()->associate($user);
//         $this->assertEquals('User', $favorite->user->name);
//     }

//     /** @test */
//     public function a_like_belongs_to_a_review()
//     {
//         $review = new \App\Models\Review(['content' => 'Great book!']);
//         $like = new \App\Models\Like();
//         $like->review()->associate($review);
//         $this->assertEquals('Great book!', $like->review->content);
//     }

//     /** @test */
//     public function a_like_belongs_to_a_review_and_a_user()
//     {
//         $user = new \App\Models\User(['name' => 'User']);
//         $review = new \App\Models\Review(['content' => 'Great book!']);
//         $like = new \App\Models\Like();
//         $like->user()->associate($user);
//         $like->review()->associate($review);
//         $this->assertEquals('User', $like->user->name);
//         $this->assertEquals('Great book!', $like->review->content);
//     }
}
