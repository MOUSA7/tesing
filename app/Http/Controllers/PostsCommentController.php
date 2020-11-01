<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentsRequest;
use App\Jobs\NotifyUsersPostesCommented;
use App\Mail\CommentedMarkdown;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Comment as CommentResources;

class PostsCommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['store']);
    }

    public function index(Post $post){
       // dd(is_array($post->comment));   check is the array is be array return true else false
//       dd(get_class($post->comment));
        return CommentResources::collection($post->comment);
//        return new CommentResources($post->comment->first());
//        return $post->comment()->with('user')->get();
    }

    public function store(Post $post,StoreCommentsRequest $request){
       $comment = $post->comment()->create([
           'content'=>$request->input('content'),
           'user_id'=>$request->user()->id
       ]);

//        Mail::to($post->user)->send(
//          new CommentedMarkdown($comment)
//        );
//         $when= now()->addMinutes(1);

        Mail::to($post->user)->queue(
            new CommentedMarkdown($comment)
        );
        NotifyUsersPostesCommented::dispatch($comment);
//        Mail::to($post->user)->later($when,
//            new CommentedMarkdown($comment)
//        );

       return redirect()->back()->withStatus('Commented has been created!');
    }
    //
}
