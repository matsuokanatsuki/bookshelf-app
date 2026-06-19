<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;

class ReviewLikeSeeder extends Seeder
{

    public function run(): void
    {
        foreach (Review::all() as $review) {
            $likerIds = User::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $review->likedByUsers()->syncWithoutDetaching($likerIds);
        }
    }
}
