<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class UniqueUserBookRating implements Rule
{
    private $bookId;

    public function __construct($bookId)
    {
        $this->bookId = $bookId;
    }

    public function passes($attribute, $value)
    {
        // Check if the user has already rated the book
        return !Rating::where('user_id', Auth::id())
            ->where('book_id', $this->bookId)
            ->exists();
    }

    public function message()
    {
        return 'You have already rated this book.';
    }
}
