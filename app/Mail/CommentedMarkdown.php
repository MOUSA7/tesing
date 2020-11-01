<?php

namespace App\Mail;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommentedMarkdown extends Mailable
{
    use Queueable, SerializesModels;
    public $comment;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Commented was Posted on your {$this->comment->commentable->title} Blog Post";
        return $this->attach(
            storage_path('app/public'.'/'.$this->comment->user->image->path),
            [
                'as'  => 'Profile.jpeg',
                'mime'=> 'image/jpeg'
            ]
        )
            ->subject($subject)
            ->markdown('mail.posts.message');
    }
}