<?php //var_dump($posts); exit; ?>


@extends('layouts.main')

@section('content')
<!-- foreach posts -->
@foreach ($posts as $post)
<h2><a href="{{secure_url('/blog/'.$post->slug)}}">{{ $post->title }}</a></h2>
<div class="row">
	<div class="col-xs-7">
		<p class="text-left">
		<span class="glyphicon glyphicon-time"></span> Posted on {{date('Y-m-d H:s', strtotime($post->created_at))}}
		@if (count($post->categories) > 0)
			@define $comma = ""
			in <span class="glyphicon glyphicon-book"></span>
			@foreach ($post->categories as $category)
				{{ $comma }}<a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a>
				@if ($comma == "")
					@define $comma = ", "
				@endif
			@endforeach
		@endif
		</p>
	</div>
	<div class="col-xs-4 col-xs-push-1">
		<p class=" text-right">by <span class="glyphicon glyphicon-user"></span> <a href="{{secure_url('/user/'.$post->user->id)}}">{{ $post->user->username }}</a></p>
	</div>
</div>
<hr>
<p>{{ $post->resume }}</p>
<a class="btn btn-primary" href="{{ secure_url('/blog/'.$post->slug) }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

<hr>
@endforeach
<!-- /foreach posts -->

<!-- Pager -->
<div class="text-center">
	{!! $posts->render() !!}
</div>
@endsection

@section('sidebar')
<!-- Blog Search Well -->
<div class="well">
    <h4>Search</h4>
    <div class="input-group">
        <input type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
            @define $c=1
	        @foreach ($categories as $category)
	        @if ($c % 2 == 0)
	        <li><a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a> ({{ count($category->posts) }})
	        @endif
	        @define $c++
	        @endforeach
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-unstyled">
            @define $c=2
	        @foreach ($categories as $category)
	        @if ($c % 2 == 0)
	        <li><a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a> ({{ count($category->posts) }})
	        @endif
	        @define $c++
	        @endforeach
            </ul>
        </div>
    </div>
    <!-- /.row -->
</div>

<!-- Tags -->
<div class="well">
    <h4>Tags</h4>
    <p>...</p>
</div>

<!-- Tags -->
<div class="well">
    <h4>Top 10 Authors</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
            @foreach ($authors as $author)
             <li><a href="{{secure_url('/users/'.$author->id)}}">{{ $author->username }}</a> ({{ count($author->posts) }})
            @endforeach
            </ul>
        </div>
</div>

@endsection