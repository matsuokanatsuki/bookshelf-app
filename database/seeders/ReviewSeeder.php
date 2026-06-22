<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Book;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            #1
            [
            'user' => '山田太郎',
            'book' => '吾輩は猫である',
            'rating' => 5,
            'comment' => '猫の視点がユーモラスで何度読んでも楽しめます。',
            ],
            #2
            [
            'user' => '鈴木花子',
            'book' => '吾輩は猫である',
            'rating' => 4,
            'comment' => '物語の展開が魅力的で、登場人物も魅力的です。',
            ],
            #3
            [
            'user' => '田中一郎',
            'book' => '吾輩は猫である',
            'rating' => 3,
            'comment' => '少し難しい表現がありましたが、全体的には面白かったです。',
            ],
            #4
            [
            'user' => '佐藤美咲',
            'book' => '吾輩は猫である',
            'rating' => 5,
            'comment' => '猫の視点で描かれる日常の描写がとてもリアルで共感できました。',
            ],
            #5
            [
            'user' => '高橋健太',
            'book' => '人を動かす',
            'rating' => 4,
            'comment' => '人間関係の重要性を再認識させられる一冊でした。実践的なアドバイスが多く、参考になりました。',
            ],
            #6
            [
            'user' => '山田太郎',
            'book' => '人を動かす',
            'rating' => 5,
            'comment' => '自己啓発書として非常に有益で、実生活に活かせる内容が多かったです。',
            ],
            #7
            [
            'user' => '鈴木花子',
            'book' => '人を動かす',
            'rating' => 4,
            'comment' => '人間関係の改善に役立つ具体的な方法が紹介されており、実践的でした。',
            ],
            #8
            [
            'user' => '田中一郎',
            'book' => 'リーダブルコード',
            'rating' => 5,
            'comment' => 'コードの可読性を高めるための具体的なテクニックが紹介されており、非常に参考になりました。',
            ],
            #9
            [
            'user' => '佐藤美咲',
            'book' => 'リーダブルコード',
            'rating' => 4,
            'comment' => 'コードの品質向上に役立つ具体的なアドバイスが多く、実務に活かせる内容でした。',
            ],
            #10
            [
            'user' => '高橋健太',
            'book' => '7つの習慣',
            'rating' => 5,
            'comment' => '自己啓発書として非常に有益で、人生の指針となる内容が多かったです。',
            ],
            #11
            [
            'user' => '山田太郎',
            'book' => '7つの習慣',
            'rating' => 4,
            'comment' => '人生の成功に必要な原則が具体的に説明されており、実践的でした。',
            ],
            #12
            [
            'user' => '鈴木花子',
            'book' => '7つの習慣',
            'rating' => 5,
            'comment' => '参考になる内容が多く、自己啓発書として非常に有益でした。',
            ],
            #13
            [
            'user' => '田中一郎',
            'book' => '坊っちゃん',
            'rating' => 4,
            'comment' => 'ユーモアと風刺が効いた作品で、登場人物の個性が際立っていました。',
            ],
            #14
            [
            'user' => '佐藤美咲',
            'book' => '坊っちゃん',
            'rating' => 5,
            'comment' => '夏目漱石の代表作であり、ユー�モアと風刺が絶妙に組み合わさった作品でした。',
            ],
            #15
            [
            'user' => '高橋健太',
            'book' => '坊っちゃん',
            'rating' => 4,
            'comment' => '登場人物の個性が際立っており、ユーモアと風刺が効いた作品でした。',
            ],
            #16
            [
            'user' => '山田太郎',
            'book' => 'サピエンス全史',
            'rating' => 5,
            'comment' => '人類の歴史を俯瞰的に解説しており、非常に興味深い内容でした。',
            ],
            #17
            [
            'user' => '鈴木花子',
            'book' => 'サピエンス全史',
            'rating' => 4,
            'comment' => 'サピエンスに関する知識が深まり、非常に参考になりました。',
            ],
            #18
            [
            'user' => '田中一郎',
            'book' => 'サピエンス全史',
            'rating' => 5,
            'comment' => '人類の歴史に関する知識が深まり、興味深い内容でした。',
            ],
            #19
            [
            'user' => '佐藤美咲',
            'book' => 'Clean Code',
            'rating' => 5,
            'comment' => 'コードの品質を高めるための原則と技法が具体的に説明されており、参考になりました。',
            ],
            #20
            [
            'user' => '高橋健太',
            'book' => 'Clean Code',
            'rating' => 4,
            'comment' => '美しいコードを書くための具体的なアドバイスが多く、実務に活かせる内容でした。',
            ],
            #21
            [
            'user' => '山田太郎',
            'book' => '嫌われる勇気',
            'rating' => 5,
            'comment' => '自己肯定感を高めるための原則と技法が具体的に説明されており、非常に参考になりました。',
            ],
            #22
            [
            'user' => '鈴木花子',
            'book' => '嫌われる勇気',
            'rating' => 4,
            'comment' => '自己肯定感を高めるための具体的なアドバイスが多く、実践的でした。',
            ],
            #23
            [
            'user' => '田中一郎',
            'book' => '嫌われる勇気',
            'rating' => 5,
            'comment' => '嫌われる勇気を持つことの重要性が具体的に説明されており、面白い内容でした。',
            ],
            #24
            [
            'user' => '佐藤美咲',
            'book' => '火花',
            'rating' => 4,
            'comment' => '芸人の世界を描いた作品で、登場人物の心理描写がリアルで共感できました。',
            ],
            #25
            [
            'user' => '高橋健太',
            'book' => '火花',
            'rating' => 5,
            'comment' => '文章も美しく、読み応えがありました。',
            ],
            #26
            [
            'user' => '山田太郎',
            'book' => '火花',
            'rating' => 4,
            'comment' => '芸人さんならではの世界観が描かれており、興味深く読みました。',
            ],
            #27
            [
            'user' => '鈴木花子',
            'book' => '火花',
            'rating' => 5,
            'comment' => '小説としての完成度が高く、感動しました。',
            ],
            #28
            [
            'user' => '田中一郎',
            'book' => 'FACTFULNESS',
            'rating' => 5,
            'comment' => '世界の現状を客観的に理解するための原則と技法が具体的に説明されており、非常に参考になりました。',
            ],
            #29
            [
            'user' => '佐藤美咲',
            'book' => 'FACTFULNESS',
            'rating' => 4,
            'comment' => '世界の現状を正しく理解するための具体的なアドバイスが多く、実践的でした。',
            ],
            #30
            [
            'user' => '高橋健太',
            'book' => 'FACTFULNESS',
            'rating' => 5,
            'comment' => '事実に基づいた世界の理解が深まりました。',
            ],
            #31
            [
            'user' => '山田太郎',
            'book' => 'コンテナ物語',
            'rating' => 5,
            'comment' => 'コンテナの歴史や技術的な側面が詳しく説明されており、非常に参考になりました。',
            ],
            #32
            [
            'user' => '鈴木花子',
            'book' => 'コンテナ物語',
            'rating' => 4,
            'comment' => '海上輸送の歴史が詳しく説明されており、とても面白かったです。',
            ],
        ];

        foreach ($reviews as $review) {
            $user = User::where('name', $review['user'])->first();
            $book = Book::where('title', $review['book'])->first();

            if ($user && $book) {
                Review::create([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                    'rating' => $review['rating'],
                    'comment' => $review['comment'],
                ]);
            }
        }
    }
}


