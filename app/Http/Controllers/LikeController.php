<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggle(Review $review): RedirectResponse
    {
        $user = Auth::user();

        if ($review->likedByUsers()->where('review_id', $review->id)->exists()) {
            $review->likedByUsers()->detach($review->id);
        } else {
            $review->likedByUsers()->attach($review->id);
        }

        return back();
    }
}
