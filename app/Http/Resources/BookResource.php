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
        $totalRating = $this->total_rating();
        $ratedPeople = $this->total_people();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url,
            'extension' => $this->extension,
            'file_size' => $this->file_size,
            'description' => $this->description,
            'rated_people' => $ratedPeople,
            'total_rating' => $totalRating,
            'average_rating' => ($ratedPeople > 0) ? ($totalRating / $ratedPeople) : 0,
            'reviews' => $this->reviews
        ];
    }
}
