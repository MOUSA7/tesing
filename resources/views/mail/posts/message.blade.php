@component('mail::message')

#Commented was posted on your blog Post
Hi{{$comment->commentable->user->name}}  <img src="{{$comment->user->image->url()}}" alt="">

@component('mail::button',['url'=>route('posts.show',['post'=>$comment->commentable->id])])
View The Blog Post
@endcomponent

@component('mail::button',['url'=>route('users.show',['user'=>$comment->user->id])])
    Visit {{$comment->user->name}} Profile
@endcomponent

@component('mail::panel')
{{$comment->content}}
@endcomponent

Tanks ,<br>
    {{config('app.name')}}
@endcomponent






{{--<h2>Welcome To my Message</h2>--}}
{{--<div>--}}
{{--    <p>this is consider Post {{$comment->commentable->user->name}}</p>--}}
{{--</div>--}}
