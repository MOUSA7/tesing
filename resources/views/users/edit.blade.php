@extends('layouts.app')

@section('content')
    <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
        @csrf
        @method('PATCH')
        <div class="container">
        <div class="row">
            <div class="col-sm-4">
                @if(session()->has('status'))
                    <ul class="alert alert-success" style="list-style: none">
                        <li>{{session()->get('status')}}</li>
                    </ul>
                @endif
                <img src="{{$user->image ? $user->image->url():''}}" class="img-thumbnail avatar" alt="">
                <div class="card mt-4">
                    <div class="card-body">
                        <h6>Upload a different photo</h6>
                        <input type="file" name="avatar" class="form-control-file">
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label for="name">{{__('Name:')}} :</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="form-group">
                    <label>{{__('Language:')}}</label>
                    <select  class="form-control" name="locale">
                        @foreach(\App\User::LOCALES as $locale => $label)
                            <option value="{{$locale}}" {{$user->locale != $locale ?: 'selected'}}>
                                {{$label}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="{{__('Save changes')}}">
                </div>
            </div>
            @include('partials.error_message')
        </div>
        </div>
    </form>
    @stop
