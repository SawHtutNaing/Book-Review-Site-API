<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Review $review): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Review $review): bool
    {
        if (!($user->role == 'admin' || $user->id == $review->user_id)) {
            throw new AuthorizationException("Only admin and the review owner can update.", 403);
            return false;
        };
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Review $review): bool
    {
        if (!($user->role == 'admin' || $user->id == $review->user_id || $user->id ==  $review->book->user_id)) {
            throw new AuthorizationException("Only admin , the book owner and the review owner can delete.", 403);
            return false;
        };
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Review $review): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Review $review): bool
    {
        //
    }
}
