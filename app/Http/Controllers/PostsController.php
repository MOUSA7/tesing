<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Image;
use App\Post;
use App\Services\Counter;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

//use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    private $counter;

    public function __construct(Counter $counter)
    {
        $this->middleware('auth')->except('index','contact','secret','show');
        $this->counter = $counter;
    }

    public function index(){
//        DB::connection()->enableQueryLog();
        $posts = Post::latestwithrelations()->get();
//        $most_commented = Post::MostCommented()->take(3)->get();
//        $active_users = User::activeusers()->take(3)->get();
//        $activeUsersLastMonths = User::MostCommentedLastMonth()->take(3)->get();



//        $posts = Post::posts()->withCount('comment')->get();  /* posts()=> Scope Name in Post Model */
//        foreach ($posts as $post){
//            foreach ($post->comment as $comment){
//                echo $comment->id.'-'.$comment->content;
//            }
//        }
//        dd(DB::getQueryLog());        Print Query sentence
        return view('posts.index',compact('posts','most_commented','active_users','activeUsersLastMonths'));
    }

    public function show($id){
        \request()->session()->reflash();
//        return view('posts.show',['post'=>Post::with(['comment'=> function($query){
//           return $query->latest();
//                             }])->findOrFail($id),
//            ]);
        $post = Cache::remember("post-{$id}",60,function () use ($id){
            return Post::with('comment','tags','user','comment.user')->findOrFail($id);
        });

       // $counter = resolve(Counter::class);
//        dump( resolve(Counter::class));
//        dump( resolve(Counter::class));
//        dump( resolve(Counter::class));

        return view('posts.show',['post'=>$post,'counter'=>$this->counter->increment("Post-{$id}")]);
    }

    public function create(){
//        $this->authorize('posts.create');
        return view('posts.create');
    }

    public function store(PostRequest $request){

        $user = Auth::user();
        $validateData = $request->validated();
        $post = $user->posts()->create($validateData);


        if ($request->hasFile('image')){
          $path =  $request->file('image')->store('images');
            $post->image()->save(
                Image::make(['path'=>$path])
            );
          }

        //$post->tags()->attach($tag1);
        //$post->tags()->detach($tag1);
        //$post->tags()->attach([$tag1->id,$tag2->id]);
        //$post->tags()->syncWithoutDetaching([$tag1->id,$tag2->id,$tag3->id]);   Just attach tag3
        //$post->tags()->sync([$tag1->id,$tag2->id]);

        $request->session()->flash('status','Blog Post was Created');

         return redirect()->route('posts.show',['post'=>$post->id]);
//        return redirect('posts');
    }

    public function edit($id){
        $post = Post::findOrFail($id);
//        if (Gate::denies('edit-post',$post)){
//            abort(403,"You can,t edit this is Post");
//        }
//        $this->authorize(['edit-post'],$post);
//        $this->authorize($post);
        return view('posts.edit',['post'=>$post]);
    }

    public function update(PostRequest $request,$id){

        $post = Post::findOrFail($id);
//        $this->authorize($post);

        $validateData = $request->validated();
        $post->fill($validateData);    //fill() method coming fillable model which (fill data)
        $post->save();
        if ($request->hasFile('image')){
            $path =  $request->file('image')->store('images');
            if ($post->image){
//                dd($post->image->path);
               Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            }else{
                $post->image()->save(
                    Image::make(['path'=>$path])
                );
            }
        }
        $request->session()->flash('status','Blog Post was Updated');
        return redirect()->route('posts.show',['post'=>$post->id]);

    }

    public function destroy($id){

        $post = Post::findOrFail($id);
//        if (Gate::denies('delete-post',$post)){
//            abort(403,"You can,t deleted this is Post");
//        }
//        $this->authorize(['delete-post'],$post);
        $post->delete();
//        Post::destroy($id);
        \request()->session()->flash('status','Blog Post was Deleted');
        return redirect('posts');
    }

    public function contact(){
        return view('contact');
    }

    public function secret(){
        return view('posts.secret');
    }

    public function trash(){
        $trash = Post::withTrashed()->get();
        return view('posts.index',compact('trash'));
    }

    //
}
