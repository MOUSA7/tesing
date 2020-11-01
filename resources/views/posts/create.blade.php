@extends('layouts.app')

@section('content')

    <div class="container">
        <h2>{{__('Create Post')}}</h2>
        <hr>
        @include('partials.error_message')
        <form action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('partials._form')
        </form>

    </div>
@stop
