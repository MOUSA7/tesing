<?php


namespace App\Http\ComposerView;


use App\Post;
use App\User;
use Illuminate\View\View;

class ComposerActivity
{
    public function compose(View $view){
        $most_commented = Post::MostCommented()->take(3)->get();
        $active_users = User::activeusers()->take(3)->get();
        $activeUsersLastMonths = User::MostCommentedLastMonth()->take(3)->get();

        $view->with('most_commented',$most_commented);
        $view->with('active_users',$active_users);
        $view->with('activeUsersLastMonths',$activeUsersLastMonths);
    }

}
