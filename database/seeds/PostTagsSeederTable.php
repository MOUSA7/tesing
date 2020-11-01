<?php

use Illuminate\Database\Seeder;

class PostTagsSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Post::all()->each(function (\App\Post $post){
            $tags = \App\Tag::inRandomOrder(1,2)->get()->pluck('id');
           $post->tags()->sync($tags);
        });
        //
    }
}
