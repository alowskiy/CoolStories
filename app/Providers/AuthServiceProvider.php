<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        \Gate::define('create-post', function (User $user) {
            return $user->active == 1;
        });
        \Gate::define('delete-post', function (User $user, Post $post) {
            return $user->id == $post->user_id && $user->active = 1;
        });

        \Gate::define('update-user', function (User $user) {
            return $user->id == \Auth::user()->id && $user->active = 1;
        });
    }
}
