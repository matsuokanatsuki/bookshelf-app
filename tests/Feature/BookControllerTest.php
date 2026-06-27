<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use App\Models\Genre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * 書籍一覧ページが正常に表示される
     */

    public function test_book_index_returns_successful_response(): void
    {
        $response = $this->get('/books');
        $response->assertStatus(200);
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
     * 書籍詳細ページが正常に表示される
     */
    public function test_book_show_returns_successful_response(): void
    {
        $book = Book::factory()->create();
        $response = $this->get("/books/{$book->id}");
        $response->assertStatus(200);
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
}
