<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index($tagId){
        $tag= Tag::findOrFail($tagId);
        $posts = $tag->posts()->latestwithrelations()->get();
        return view('posts.index',['posts'=>$posts]);
    }
    //
}
