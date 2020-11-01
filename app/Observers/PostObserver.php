<?php

namespace App\Observers;

use App\Post;

class PostObserver
{

    public function deleting(Post $post)
    {
//        dd('i am deleted');
        $post->comment()->delete();
    }
}
