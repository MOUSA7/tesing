@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ __('Display Post')}}</h2>
        <hr>
        <div>
            <a class="btn btn-success btn-xs" href="{{route('posts.create')}}">{{__('Create!')}}</a>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <br>

                @if(session()->has('status'))
                    <ul class="alert alert-success" style="list-style: none">
                        <li>{{session()->get('status')}}</li>
                    </ul>
                @endif

                @forelse($posts as $post)


                    @if($post->trashed())
                        <del>
                            @endif
                            <a class="{{$post->trashed() ? 'text-muted':''}}"
                               href="{{route('posts.show',$post->id)}}">{{Str::limit($post->title,80)}}</a>
                            @if($post->trashed())
                        </del>
                    @endif
                    <p>
                        {{Str::limit($post->content,150)}}
                    </p>
                    {{--                            {{$post->created_at->diffForHumans()}}/--}}
                    {{--                            {{$post->user ? $post->user->name :'No user'}}--}}
                    <p>
                        @updated(['date'=>$post->created_at,'name'=> $post->user->name,'userId'=>$post->user->id])
                        @tags(['tags' => $post->tags])
                    </p>

                    <a class="btn btn-info btn-xs" href="{{route('posts.show',$post->id)}}">Show</a>
                    @if(!$post->trashed())
                        @can('delete',$post)
                            <a class="btn btn-danger btn-xs" href="{{route('posts.destroy',$post->id)}}">{{__('Delete')}}</a>
                        @endcan
                        {{--               @cannot('delete',$post)--}}
                        {{--                 <span><a href="">can't deleted this post</a></span>--}}
                        {{--               @endcannot--}}
                        @can('update',$post)
                            <a class="btn btn-primary btn-xs" href="{{route('posts.edit',$post->id)}}">{{__('Edit')}}</a>
                        @endcan
                    @endif

{{--                    @if($post->comment_count)--}}
{{--                        <p>{{$post->comment_count}} Comments</p>--}}
{{--                    @else--}}
{{--                        <p>No Comments Yet !</p>--}}
{{--                    @endif--}}

                   <p>{{trans_choice('messages.comments',$post->comment_count)}}</p>




                    {{--           <td>--}}
                    {{--               <form method="POST" action="{{route('posts.destroy',$post->id)}}">--}}
                    {{--                   @csrf--}}
                    {{--                   @method('DELETE')--}}
                    {{--                   <input type="submit" value="Delete" class="btn btn-danger">--}}
                    {{--               </form>--}}
                    {{--           </td>--}}

                @empty
                    <p>No Blog Posts yet ?</p>
                @endforelse

            </div>
            <div class="col-sm-3">
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

                    {{--                <div class="row mt-4">--}}
                    {{--                    <div class="card" style="width: 18rem;">--}}
                    {{--                        <div class="card-header">--}}
                    {{--                            Most Active Users--}}
                    {{--                        </div>--}}
                    {{--                        <ul class="list-group list-group-flush">--}}
                    {{--                            @foreach($active_users as $user)--}}
                    {{--                                <li class="list-group-item">  {{$user->name}}</li>--}}
                    {{--                            @endforeach--}}
                    {{--                        </ul>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}

                    @card(['title'=>' Most Active Users'])
                    @slot('active_users',collect($active_users))

                    {{--                <div class="row mt-2">--}}
                    {{--                    <div class="card" style="width: 18rem;">--}}
                    {{--                        <div class="card-header">--}}
                    {{--                            Most Active Users Last Month--}}
                    {{--                        </div>--}}
                    {{--                        <ul class="list-group list-group-flush">--}}
                    {{--                            @foreach($activeUsersLastMonths as $user)--}}
                    {{--                                <li class="list-group-item">  {{$user->name}}</li>--}}
                    {{--                            @endforeach--}}
                    {{--                        </ul>--}}
                    {{--                    </div>--}}
                    {{--                </div>--}}

                    {{--                @card(['title'=>'Most Active Users Last Month'])--}}
                    {{--                @slot('activeUsersLastMonths',collect($activeUsersLastMonths))--}}
                </div>

            </div>
        </div>


    </div>
@stop
