<?php

use Illuminate\Database\Seeder;

class CommentSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = \App\Post::all();

        if ($posts->count() === 0){
            $this->command->info('There are no blog posts , So no Comment yet');
            return;
        }
        $commentCount = (int)$this->command->ask('How Many Comments Would you lik ?',150);
        $users = \App\User::all();
        factory(\App\Comment::class,$commentCount)->make()->each(function ($comment)use($posts,$users){
           $comment->post_id = $posts->random()->id;
//           $comment->user_id = $users->random()->id;
           $posts->save();
        });
        //
    }
}
