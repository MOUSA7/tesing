@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <br>
            {{--            <h6>@lang('messages.welcome')</h6>--}}
            {{--            <p>{{__('messages.DisplayName',['name'=>' John'])}}</p>--}}

            <p>{{trans_choice('messages.plural',0,['a'=>1])}}</p>
            <p>{{trans_choice('messages.plural',1,['a'=>1])}}</p>
            <p>{{trans_choice('messages.plural',4,['a'=>1])}}</p>
            <h3>Welcome To My Laravel Application !</h3>
            <h4>Using Json {{__('Welcome to Laravel!')}}</h4>
            <h4>Using Json  {{__('Hello:name',['name'=>'piotr'])}}</h4>
        </div>
    </div>
</div>
@endsection
