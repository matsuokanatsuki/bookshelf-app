<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use App\Models\Genre;
use App\Models\Review;
use App\Models\Favorite;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * ユーザー・ゲストは/booksで書籍一覧ページを表示できる
     */

    public function test_book_index_returns_successful_response(): void
    {
        $response = $this->get('/books');
        $response->assertStatus(200);
    }
    /**
     * 認証済みユーザーは/books/createで書籍登録ページを表示できる
     */
    public function test_authenticated_user_can_access_book_create_page(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/books/create');
        $response->assertStatus(200);
    }
    /**
     * 未認証ユーザーは/books/createで書籍登録ページを表示できず、ログインページにリダイレクトされる
     */
    public function test_guest_cannot_access_book_create_page(): void
    {
        $response = $this->get('/books/create');
        $response->assertRedirect('/login');
    }

    /**
     * 認証済みユーザーが書籍を作成できる
     */
    public function test_authenticated_user_can_create_book(): void
    {
        $user = User::factory()->create();
        $genre = Genre::factory()->create();

        $this->actingAs($user);

        $response = $this->post('/books', [
            'title' => 'テスト書籍',
            'author' => 'テスト著者',
            'isbn' => '1234567890123',
            'published_at' => '2023-01-01',
            'description' => 'テスト説明',
            'image_url' => 'http://example.com/image.jpg',
            'genres' => [$genre->id],
        ]);

        $response->assertRedirect('/books');
        $this->assertDatabaseHas('books', ['title' => 'テスト書籍']);
    }
    /**
     * 未認証ユーザーは書籍を作成できず、ログインページにリダイレクトされる
     */
    public function test_guest_cannot_create_book(): void
    {
        $genre = Genre::factory()->create();
        $response = $this->post('/books', [
            'title' => 'テスト書籍',
            'author' => 'テスト著者',
            'isbn' => '1234567890123',
            'published_at' => '2023-01-01',
            'description' => 'テスト説明',
            'image_url' => 'http://example.com/image.jpg',
            'genres' => [$genre->id],
        ]);

        $response->assertRedirect('/login');
    }
    /**
     * バリデーションエラーが発生した場合、エラーメッセージが表示される
     */
    public function test_book_creation_validation_errors(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $genre = Genre::factory()->create();

        $response = $this->post('/books', [
            'title' => '',
            'author' => '',
            'isbn' => '',
            'published_at' => '',
            'description' => '',
            'image_url' => '',
            'genres' => [],
        ]);

        $response->assertSessionHasErrors(['title', 'author', 'isbn', 'published_at', 'genres']);
    }

    /**
     * 作成した書籍にジャンルが正しく紐付けられる
     */
    public function test_book_genres_are_attached_correctly(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $genre1 = Genre::factory()->create();
        $genre2 = Genre::factory()->create();

        $response = $this->post('/books', [
            'title' => 'テスト書籍',
            'author' => 'テスト著者',
            'isbn' => '1234567890123',
            'published_at' => '2023-01-01',
            'description' => 'テスト説明',
            'image_url' => 'http://example.com/image.jpg',
            'genres' => [$genre1->id, $genre2->id],
        ]);

        $book = Book::where('title', 'テスト書籍')->first();
        $this->assertTrue($book->genres->contains($genre1));
        $this->assertTrue($book->genres->contains($genre2));
    }

    /**
     * ユーザー・ゲストは書籍詳細ページを表示できる
     */
    public function test_book_show_returns_successful_response(): void
    {
        $book = Book::factory()->create();
        $response = $this->get("/books/{$book->id}");
        $response->assertStatus(200);
    }

    /**
     * 書籍データ作成者のみが書籍編集ページを表示できる
     */
    public function test_only_creator_can_access_book_edit_page(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['created_by' => $user->id]);
        $this->actingAs($user);
        $response = $this->get("/books/{$book->id}/edit");
        $response->assertStatus(200);
    }

    /**
     * 書籍データ作成者以外のユーザーは書籍編集ページを表示できず、403エラーが返る
     */
    public function test_non_creator_cannot_access_book_edit_page(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['created_by' => $user->id]);
        $otherUser = User::factory()->create();
        $this->actingAs($otherUser);
        $response = $this->get("/books/{$book->id}/edit");
        $response->assertStatus(403);
    }

    /**
     * 認証済みユーザーが書籍を更新できる
     */
    public function test_authenticated_user_can_update_book(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['created_by' => $user->id]);
        $genre = Genre::factory()->create();

        $this->actingAs($user);

        $response = $this->put("/books/{$book->id}", [
            'title' => '更新後の書籍',
            'author' => '更新後の著者',
            'isbn' => '9876543210987',
            'published_at' => '2024-01-01',
            'description' => '更新後の説明',
            'image_url' => 'http://example.com/updated_image.jpg',
            'genres' => [$genre->id],
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect("/books/{$book->id}");
        $this->assertDatabaseHas('books', ['title' => '更新後の書籍']);
    }

    /**
     * バリデーションエラーが発生した場合、エラーメッセージが表示される
     */
    public function test_book_update_validation_errors(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['created_by' => $user->id]);

        $this->actingAs($user);

        $response = $this->put("/books/{$book->id}", [
            'title' => '',
            'author' => '',
            'isbn' => '',
            'published_at' => '',
            'description' => '',
            'image_url' => '',
            'genres' => [],
        ]);

        $response->assertSessionHasErrors(['title', 'author', 'isbn', 'published_at', 'genres']);
    }

    /**
     * 認証済みユーザーが書籍を削除できる
     */
    public function test_authenticated_user_can_delete_book(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['created_by' => $user->id]);

        $this->actingAs($user);

        $response = $this->delete("/books/{$book->id}");

        $response->assertRedirect('/books');
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }

    /**
     * 関連するレビュー、お気に入り、ジャンルの紐付けも削除される
     */
    public function test_related_reviews_favorites_and_genres_are_deleted_with_book(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['created_by' => $user->id]);
        $genre = Genre::factory()->create();
        $book->genres()->attach($genre->id);
        $review = Review::factory()->create(['book_id' => $book->id]);
        $favorite = Favorite::factory()->create(['book_id' => $book->id]);

        $this->actingAs($user);
        $response = $this->delete("/books/{$book->id}");

        $response->assertRedirect('/books');
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
        $this->assertDatabaseMissing('reviews', ['id' => $review->id]);
        $this->assertDatabaseMissing('favorites', ['id' => $favorite->id]);
        $this->assertDatabaseMissing('book_genre', ['book_id' => $book->id, 'genre_id' => $genre->id]);
    }

    /**
     * 書籍データ作成者以外のユーザーは書籍を削除できず、403エラーが返る
     */
    public function test_non_creator_cannot_delete_book(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create(['created_by' => $user->id]);
        $otherUser = User::factory()->create();
        $this->actingAs($otherUser);
        $response = $this->delete("/books/{$book->id}");
        $response->assertStatus(403);
    }
}