@extends('layouts.main')

@section('header')
<h1 class="page-header">
    <div class="row">
        <div class="col-xs-7">
            User <small> {{ $user->usernamename }} </small>
        </div>
        {{-- Check if the user is logged and is admin, moderator or editor --}}
        @if (Auth::check() && in_array(Auth::user()->role(Auth::user()->id), ['admin', 'moderator', 'editor']))
        <div class="col-xs-4 col-xs-push-1">
            <div class="text-right" style="font-size:40%;margin-top:20px">
                <span class="glyphicon glyphicon-pencil"></span> <a href="{{secure_url('/user/edit/'.$user->id)}}">Edit</a>
            </div>
        </div>
        @endif
    </div>
</h1>
@endsection

@section('content')
<div class="row">
    <div class="row">
        <div class="col-xs-7">
        <h3>Personal info:</h3>
        <p><strong>Name:</strong> {{ $user->first_name . ' ' . $user->last_name }}</p>
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Class:</strong> {{ $user->role($user->id) }}</p>
        </div>
    </div>
    <div class="col-xs-7">
        <h3>Latest posts:</h3>
        <ul>
        @foreach ($user->posts as $post)
            <li><a href="{{ secure_url('blog/'.$post->slug) }}">{{ $post->title }}</a></li>
        @endforeach
        </ul>
    </div>
</div>
@endsection