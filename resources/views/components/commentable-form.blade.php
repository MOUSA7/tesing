@auth
    <form method="POST" action="{{$route}}"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <textarea type="text"  name="content" class="form-control" placeholder="Content"></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block">add Comment</button>

    </form>
    @include('partials.error_message')
@else
    <a href="{{route('login')}}">Sign-In</a> to Create Post Comment

@endauth
<hr/>
