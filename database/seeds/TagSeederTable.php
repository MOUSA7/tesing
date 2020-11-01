<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags =collect(['sport','Environment','Economic','political','Health']) ;
        //
        $tags->each(function ($tagName){
           $tag = new Tag();
           $tag->name = $tagName;

           $tag->save();
        });
    }
}
