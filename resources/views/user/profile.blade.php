@extends('layouts.main')

@section('header')
<h1 class="page-header">User <small>{{ $user->username }}</small></h1>
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