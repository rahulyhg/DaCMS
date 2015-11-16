@extends('layouts.main')

@section('header')
<h1 class="page-header">
	<div class="row">
	 	<div class="col-xs-7">
			Category <small> {{ $category->name }} </small>
		</div>
		{{-- Check if the user is logged and is admin, moderator or editor --}}
		@if (Auth::check() && in_array(Auth::user()->role(Auth::user()->id), ['admin', 'moderator', 'editor']))
		<div class="col-xs-4 col-xs-push-1">
			<div class="text-right" style="font-size:40%;margin-top:20px">
				<span class="glyphicon glyphicon-pencil"></span> <a href="{{secure_url('/category/edit/'.$category->id)}}">Edit</a>
			</div>
		</div>
		@endif
	</div>
</h1>
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
