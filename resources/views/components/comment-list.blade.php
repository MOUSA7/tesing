<ul style="list-style: none">
    @foreach($comments as $comment)
        <li>
            {{$comment->id}}-{{$comment->content}}
            @updated(['date'=>$comment->created_at,'name'=> $comment->user->name,'userId'=>$comment->user->id])
        </li>
    @endforeach
</ul>

