<?php

namespace App\Observers;

use App\Comment;
use App\Post;
use App\User;

class CommentObserver
{

    public function creating(Comment $comment)
    {
//        dd('i am created');
        if ($comment->commentable_type === Post::class or $comment->commentable_type === User::class) {
            return true;
//                dd($comment);
            //
        }
    }

}
