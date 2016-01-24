@extends('layouts.main')

@section('meta')
<?php
// meta users
$layout->title = 'Profile of user: ' . $user->name;
$layout->description = 'Profile of user: ' . $user->name;
$layout->keywords = 'posts, user, ' . $user->name;
$layout->canonical = secure_url('user/'.$user->id)
?>
@endsection

@section('content')

<h1 class="page-header">
    <div class="row">
        <div class="col-xs-7">
            user <small> {{ $user->name }} </small>
        </div>
        @if ($authUser && $authUser->role > 6)
        <div class="col-xs-4 col-xs-push-1">
            <div class="text-right" style="font-size:40%;margin-top:20px">
                <span class="glyphicon glyphicon-pencil"></span> <a href="{{secure_url('/user/edit/'.$user->id)}}">Edit</a>
            </div>
        </div>
        @endif
    </div>
</h1>
<div class="row">
    <div class="row">
        <div class="col-xs-7">
        <h3>Personal info:</h3>
        <p><strong>Name:</strong> {{ $user->first_name . ' ' . $user->last_name }}</p>
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Class:</strong> {{ $user->role }}</p>
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