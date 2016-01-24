@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'Tag: ' . $tag->name;
$layout->description = 'Posts with tag ' . $tag->name;
$layout->keywords = 'posts, tag, ' . $tag->name;
$layout->canonical = secure_url('tag/'.$tag->slug)
?>
@endsection

@section('content')

<h1 class="page-header">
	<div class="row">
	 	<div class="col-xs-7">
			tag <small> {{ $tag->name }} </small>
		</div>
		@if ($authUser && $authUser->role > 6)
		<div class="col-xs-4 col-xs-push-1">
			<div class="text-right" style="font-size:40%;margin-top:20px">
				<span class="glyphicon glyphicon-pencil"></span> <a href="{{secure_url('/tag/edit/'.$tag->id)}}">Edit</a>
			</div>
		</div>
		@endif
	</div>
</h1>

<div class="row">
    <div class="col-xs-7">
    <h3>Posts:</h3>
    @foreach ($tag->posts as $post)
    <li><a href="{{ secure_url('blog/'.$post->slug) }}">{{ $post->title }}</a></li>
    @endforeach
    </div>
</div>
@endsection