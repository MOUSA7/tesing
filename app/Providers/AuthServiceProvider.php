<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Model' => 'App\Policies\ModelPolicy',
        'App\Post'  =>   'App\Policies\PostPolicy',
        'App\User'  =>    'App\Policies\UserPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('secret-data',function ($user){            // when add secret data in the view page
           return $user->is_admin;
        });

//        Gate::define('edit-post',function ($user,$post){
//           return $user->id == $post->user_id;
//        });
//
//        Gate::define('delete-post',function ($user,$post){
//            return $user->id == $post->user_id;
//        });

//        Gate::define('post.update','App\Policies\PostPolicy@update');
//        Gate::define('post.delete','App\Policies\PostPolicy@delete');

//        Gate::resource('posts','App\Policies\PostPolicy');
        // posts.create ,  posts.edit  ,  posts.delete ,posts.view

//        Gate::before(function ($user,$ability){
//            if ($user->is_admin && in_array($ability,['post.update','post.delete'])){
//                return true;
//            }
//        });

        Gate::before(function ($user,$ability){
           if ($user->is_admin && in_array($ability,['update'])){
             return true;
           }
        });

//        Gate::after(function ($user,$ability,$result){
//           if ($user->is_admin){
//               return true;
//           }
//        });
        //
    }
}
