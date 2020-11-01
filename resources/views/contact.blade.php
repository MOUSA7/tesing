@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Contact Page</h2>
        <hr>
        <br>
        @can('secret-data')
            <a href="{{route('secret')}}"><p>Secret Data</p></a>
        @endcan
    </div>
@stop
