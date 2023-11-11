<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function total_rating()
    {
        return $this->hasMany(Rating::class)->sum('rating');
    }

    public function total_people()
    {
        return $this->hasMany(Rating::class)->count();
    }

    public function reviews()
    {
        return  $this->hasMany(Review::class);
    }
}
