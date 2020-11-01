<div class="row mt-2">
    <div class="card" style="width: 18rem;">
        <div class="card-header">
            {{$title}}
        </div>
        <ul class="list-group list-group-flush">
{{--            @if(is_a($active_users,'Illuminate\Support\Collection'))--}}
            @foreach($active_users as $user)
                <li class="list-group-item">
                    {{$user->name}}
                </li>
            @endforeach
{{--            @else--}}
{{--                {{$active_users}}--}}
{{--            @endif--}}
        </ul>
    </div>
</div>



{{--<div class="row mt-2">--}}
{{--    <div class="card" style="width: 18rem;">--}}
{{--        <div class="card-header">--}}
{{--            {{$title}}--}}
{{--        </div>--}}
{{--        <ul class="list-group list-group-flush">--}}
{{--            @if(is_a($activeUsersLastMonths,'Illuminate\Support\Collection'))--}}
{{--                @foreach($activeUsersLastMonths as $user)--}}
{{--                    <li class="list-group-item">--}}
{{--                        {{$user->name}}--}}
{{--                    </li>--}}
{{--                @endforeach--}}
{{--            @else--}}
{{--                {{$active_users}}--}}
{{--            @endif--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--</div>--}}
