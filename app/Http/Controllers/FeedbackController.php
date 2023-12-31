<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeedbackRequest;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class FeedbackController extends Controller
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
    public function store(StoreFeedbackRequest $request)
    {



        $book_id = $request->book_id;
        $book = Book::findOrFail($book_id);


        if (!is_null($request->review_text)) {
            $review_text = $request->review_text;

            Review::insert([
                'book_id' => $book_id,
                'review_text' => $review_text,
                'user_id' => Auth::id(),
                'created_at' => now(),
                'updated_at' => now()

            ]);
        }
        if (!is_null($request->rating)) {
            $rating = $request->rating;

            if (Gate::allows('feedback-book', $book)) {
                return response()->json([
                    "message" => "You can not rate your book yourself"
                ]);
            }
            Rating::insert(
                [
                    'book_id' => $book_id,
                    'rating' => $rating,
                    'user_id' => Auth::id(),
                    'created_at' => now(),
                    'updated_at' => now()

                ]
            );
        }
        return response()->json([
            "message" => "You gave feedback successfully",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
