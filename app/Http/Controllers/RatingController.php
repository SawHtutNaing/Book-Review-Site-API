<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Http\Requests\StoreRatingRequest;
use App\Http\Requests\UpdateRatingRequest;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRatingRequest $request)
    {
        $book_id = $request->book_id;
        $rating = $request->rating;

        $book = Book::findOrFail($book_id);
        //book owner can not rate his book to get real reaction
        if (Gate::allows('feedback-book', $book)) {
            return response()->json([
                "message" => "You can not rate your book yourself"
            ]);
        }




        $rate =   Rating::insert(
            [
                'book_id' => $book_id,
                'rating' => $rating,
                'user_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now()

            ]
        );
        return response()->json([
            "message" => "You have rated successfully",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRatingRequest $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
