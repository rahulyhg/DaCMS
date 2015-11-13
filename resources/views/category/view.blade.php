@extends('layouts.main')

@section('header')
<h1 class="page-header">Category <small>{{$category->name}}</small></h1>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-7">

    <h3>Posts:</h3>
    @foreach ($category->posts as $post)
    <li><a href="{{ secure_url('blog/'.$post->slug) }}">{{ $post->title }}</a></li>
    @endforeach
    </div>
</div>
@endsection
