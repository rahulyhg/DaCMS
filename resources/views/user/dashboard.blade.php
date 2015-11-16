@extends('layouts.main')

@section('header')
<h1 class="page-header">DaCMS <small>dashboard</small></h1>
@endsection

@section('content')

<div class="col-xs-8">
    <h3>Personal info:</h3>
    <p><strong>Name:</strong> {{ $user->first_name . ' ' . $user->last_name }}</p>
    <p><strong>Username:</strong> {{ $user->username }}</p>
    <p><strong>Class:</strong> {{ $user->role($user->id) }}</p>
</div>


@if (Auth::check() && in_array(Auth::user()->role(Auth::user()->id), ['owner','admin']))
    <div class="col-xs-8">
        <h3>Admin panel:</h3>
        <br>
        <p><a href="{{ secure_url('user/add') }}">Add user</a></p>
        <p><a href="{{ secure_url('blog/add') }}">Add post</a></p>
        <p><a href="{{ secure_url('page/add') }}">Add page</a></p>
        <p><a href="{{ secure_url('tag/add') }}">Add tag</a></p>
        <p><a href="{{ secure_url('category/add') }}">Add category</a></p>
    </div>
@endif

@if (Auth::check() && in_array(Auth::user()->role(Auth::user()->id), ['moderator']))
    <div class="col-xs-8">
        <h3>Moderator panel:</h3>
        <p><a href="{{ secure_url('blog/add') }}">Add post</a></p>
        <p><a href="{{ secure_url('page/add') }}">Add page</a></p>
        <p><a href="{{ secure_url('tag/add') }}">Add tag</a></p>
        <p><a href="{{ secure_url('category/add') }}">Add category</a></p>
    </div>
@endif

@if (Auth::check() && in_array(Auth::user()->role(Auth::user()->id), ['editor']))
    <div class="col-xs-8">
        <h3>Editor panel:</h3>
        <p><a href="{{ secure_url('blog/add') }}">Add post</a></p>
        <p><a href="{{ secure_url('page/add') }}">Add page</a></p>
    </div>
@endif

@endsection