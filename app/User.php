<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public const LOCALES = [
        'en' => 'English',
        'es' => 'Español',
        'de' => 'Deutsche'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','email','created_at','updated_at','locale','is_admin','email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function scopeActiveUsers($query){
        return $query->withCount('posts')->orderBy('posts_count','desc');
    }
    public function scopeMostCommentedLastMonth( $query){
        return $query->withCount(['posts'=>function( $query){
            $query->whereBetween('created_at',[now()->subMonths(1),now()]);
        }])->has('posts','>=',2)->orderBy('posts_count','desc');
    }
    public function image(){
        return $this->morphOne(Image::class,'imageable');
    }
    public function commentOn(){
        return $this->morphMany(Comment::class,'commentable');
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function scopeThatHasCommentedPost($query,Post $post){

       return $query->whereHas('comment',function ($query) use ($post){

            return $query->where('commentable_id',$post->id)->where('commentable_type',Post::class);

            //$post = Post::find(4);
            //User::thatHasCommentedPost($post)->get() try in the tinker
        });

    }
}
