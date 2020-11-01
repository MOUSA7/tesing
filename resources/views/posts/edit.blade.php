@extends('layouts.app')

@section('content')

    <div class="container">
        @include('partials.error_message')
        <form action="{{route('posts.update',[$post->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            @include('partials._form')
        </form>
    </div>
@stop
