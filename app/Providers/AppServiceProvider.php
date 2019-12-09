<?php

namespace App\Providers;

use App\Following;
use App\Observers\FollowingObserver;
use App\Observers\PostsObserver;
use App\Post;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Post::observe(PostsObserver::class);
    }
}
