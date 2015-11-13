@extends('layouts.main')

@section('header')
<h1 class="page-header">User <small>{{ $user->username }}</small></h1>
@endsection

@section('content')
<div class="row">
    <div class="row">
        <div class="col-xs-7">
        <h3>Groups:</h3>
        <ul>
        @foreach ($user->usergroups as $group)
            <li><a href="{{ secure_url('blog/'.$group->name) }}">{{ $group->name }}</a></li>
        @endforeach
        </ul>
        </div>
    </div>
    <div class="col-xs-7">
        <h3>Posts:</h3>
        <ul>
        @foreach ($user->posts as $post)
            <li><a href="{{ secure_url('blog/'.$post->slug) }}">{{ $post->title }}</a></li>
        @endforeach
        </ul>
    </div>
</div>
@endsection