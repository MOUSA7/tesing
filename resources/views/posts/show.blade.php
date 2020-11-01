@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                @if(session()->has('status'))
                    <ul class="alert alert-success" style="list-style: none">
                        <li>{{session()->get('status')}}</li>
                    </ul>
                @endif
                @if($post->image)
                    <div
                        style="background-image: url('{{$post->image->url()}}') ;min-height: 500px;background-attachment:fixed;color: white;text-align: center">
                        <h1 style="padding-top: 100px ;text-shadow: 1px 2px #000">
                            @else
                                <h1>
                                    @endif

                                    <h4> Title Is : {{Str::limit($post->title,55)}}
                                        @if((new Carbon\Carbon())->diffInMinutes($post->created_at) < 500)
                                            {{--                    @badge(['show' => true])  condition--}}
                                            {{--                    @badge(['show'=>now()->diffInMinutes($post->created_at) < 500])--}}
                                            @badge
                                        @endif
                                    </h4>
                                    @if($post->image)
                                </h1>
                        </h1>
                    </div>
                @else

                @endif
                <hr>
                <h4>Content Is : {{$post->content}}</h4>
                    <p>Currently Read by {{$counter}} Person</p>
                <p>Added {{$post->created_at->diffForHumans()}} /by {{$post->user->name}}</p>

                @if($post->image)
                    {{$post->image->path}}
                    <img src="{{$post->image->url()}} " width="60" height="60">
                @endif

                @tags(['tags' => $post->tags])
                {{--            @if((new Carbon\Carbon())->diffInMinutes($post->created_at) < 20)--}}
                {{--                @component('posts.badge')--}}
                {{--            slot =>        New !--}}
                {{--                @endcomponent--}}
                {{--            @endif--}}

                {{--            @if((new Carbon\Carbon())->diffInMinutes($post->created_at) < 120)--}}
                {{--                @component('components.badge',['type'=>'primary'])--}}
                {{--                   New !--}}
                {{--                @endcomponent--}}
                {{--            @endif--}}
                    <h2>Comments</h2>
{{--                    @include('comments._form')--}}
                    @if($post->comment->count() >= 0)
                    @CommentForm(['route'=>route('posts.comments.store',['post'=>$post->id])])
                    @else
                        <p>No Comments yet !</p>
                    @endif
                    @CommentList(['comments'=>$post->comment,'type'=>$post])

            </div>

            <div class="col-sm-4">
            <div class="container">
                <div class="row">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header">
                            Most Commented
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($most_commented as $post)
                                <li class="list-group-item"><a
                                        href="{{route('posts.show',$post->id)}}">{{Str::limit($post->title,30)}}</a>
                                    NR: {{$post->comment->count()}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            @card(['title'=>' Most Active Users'])
            @slot('active_users',collect($active_users))

            </div>
        </div>
         </div>

    </div>



@stop
