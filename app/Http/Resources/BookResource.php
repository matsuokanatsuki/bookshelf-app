<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'published_at' => $this->published_at,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'genres' => $this->genres->pluck('name'),
            'average_rating' => $this->reviews()->avg('rating'),
            'reviews_count' => $this->reviews()->count(),
            'created_by' => $this->creator ? $this->creator->name : null,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
