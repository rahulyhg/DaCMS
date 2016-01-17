@extends('layouts.main')

@section('header')
<h1 class="page-header">DaCMS <small>dashboard</small></h1>
@endsection

@section('content')

<div class="col-xs-8">
    <h3>Personal info:</h3>
    <p><strong>Name:</strong> {{ $user->first_name . ' ' . $user->last_name }}</p>
    <p><strong>Username:</strong> {{ $user->username }}</p>
    <p><strong>Class:</strong> {{ $user->role }}</p>
</div>


@if ($user->role > 7)
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

@if ($user->role > 6)
    <div class="col-xs-8">
        <h3>Moderator panel:</h3>
        <p><a href="{{ secure_url('blog/add') }}">Add post</a></p>
        <p><a href="{{ secure_url('page/add') }}">Add page</a></p>
        <p><a href="{{ secure_url('tag/add') }}">Add tag</a></p>
        <p><a href="{{ secure_url('category/add') }}">Add category</a></p>
    </div>
@endif

@if ($user->role > 5)
    <div class="col-xs-8">
        <h3>Editor panel:</h3>
        <p><a href="{{ secure_url('blog/add') }}">Add post</a></p>
        <p><a href="{{ secure_url('page/add') }}">Add page</a></p>
    </div>
@endif

@endsection