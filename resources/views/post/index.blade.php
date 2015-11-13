@extends('layouts.main')

@section('header')
<h1 class="page-header">Blog <small>latest posts</small></h1>
@endsection

@section('content')
<!-- foreach posts -->
@foreach ($posts as $post)
<h2><a href="{{secure_url('/blog/'.$post->slug)}}">{{ $post->title }}</a></h2>
<div class="row">
	<div class="col-xs-8">
		<p class="text-left">
		<span class="glyphicon glyphicon-time"></span> {{date('d M Y H:s', strtotime($post->created_at))}}
		@if (count($post->categories) > 0)
			<span class="glyphicon glyphicon-book"></span>
			@foreach ($post->categories as $category)
                <a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a>
			@endforeach
		@endif
        @if (count($post->tags) > 0)
            <span class="glyphicon glyphicon-tag"></span>
            @foreach ($post->tags as $tag)
                <a href="{{secure_url('/tag/'.$tag->slug)}}">{{ $tag->name }}</a>
            @endforeach
        @endif
		</p>
	</div>
	<div class="col-xs-3 col-xs-push-1">
		<p class=" text-right"><span class="glyphicon glyphicon-user"></span> <a href="{{secure_url('/user/'.$post->user->id)}}">{{ $post->user->username }}</a></p>
	</div>
</div>
<hr style="margin-top:0;">
<p>{{ $post->resume }} <a title="Read more" href="{{ secure_url('/blog/'.$post->slug) }}"><span class="glyphicon glyphicon-chevron-right"></span></a></p>

<hr>
@endforeach
<!-- /foreach posts -->

<!-- Pager -->
<div class="text-center">
	{!! $posts->render() !!}
</div>
@endsection