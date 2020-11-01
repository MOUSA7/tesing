@extends('layouts.app')

@section('content')
        <div class="container">
        <div class="row">
            <div class="col-4">
                @if(session()->has('status'))
                    <ul class="alert alert-success" style="list-style: none">
                        <li>{{session()->get('status')}}</li>
                    </ul>
                @endif
                <img src="{{$user->image ? $user->image->url():'http://placehold.it/400x400'}}" height="80px" width="70%" class="img-thumbnail avatar" alt="">
            </div>
            <div class="col-8">
               <h3>{{$user->name}}</h3>
                <p>Currently view by {{$counter}}</p>
                @if($user->commentOn->count() >= 0)

                    {{route('users.comments.store',$user->id)}}

                    {{--            @CommentForm(['route'=>route('users.comments.store',['user'=>$user->id])])--}}
                    @CommentForm(['route'=>route('users.comments.store',['user'=>$user->id])])
                @else
                    <p>No Comments yet !</p>
                @endif

                @CommentList(['comments'=>$user->commentOn,'user'=>$user])
            </div>

        </div>

        </div>

    <div class="container">

    </div>

@stop
