<?php

namespace App\Providers;

use App\Comment;
use App\Http\ComposerView\ComposerActivity;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use App\Post;
use App\Services\Counter;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

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
        Schema::defaultStringLength(191); // and can use multiple 255 * 4
        Blade::include('components.badge','badge');
        Blade::include('components.update','updated');
        Blade::include('components.card','card');
        Blade::include('components.tag','tags');
        Blade::include('components.commentable-form','CommentForm');
        Blade::include('components.comment-list','CommentList');

        //when to share two view can using array[] BUT When to make share To all view in laravel make * :
        //\view()->composer('*',ComposerActivity::class);
        \view()->composer(['posts.index','posts.show'],ComposerActivity::class);
//        \view()->composer('posts.index',ComposerActivity::class);
        //
        Post::observe(PostObserver::class);
        Comment::observe(CommentObserver::class);

        $this->app->singleton(Counter::class,function ($app){
            return new Counter(5);
        });
    }
}
