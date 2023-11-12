<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use App\Policies\BookPolicy;
use App\Policies\ReviewPolicy;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Book::class => BookPolicy::class,
        Review::class => ReviewPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('feedback-book', function (User $user, Book $book) {
            return $user->id == $book->user_id;
        });
    }
}
