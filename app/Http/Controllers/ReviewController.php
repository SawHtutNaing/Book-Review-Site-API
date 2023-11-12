<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
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
    public function store(StoreReviewRequest $request)
    {
        $book_id = $request->book_id;
        $review_text = $request->review_text;
        Review::insert([
            'book_id' => $book_id,
            'review_text' => $review_text,
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now()

        ]);
        return response()->json([
            "message" => "You have gived  review successfully ."
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //system admin and review owner can update

        $this->authorize('update', $review);

        $review->review_text = $request->review_text;
        $review->update();
        return response()->json([
            "message" => "Review is updated successfuklly "
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {

        $this->authorize('delete', $review);
        //system admin , book owner and review owner can delete

        $review->delete();
        return response()->json([
            "message" => "Review is deleted successfuklly ."
        ]);
    }
}
