@extends('layouts.main')

@section('header')
<h1 class="page-header">
	<div class="row">
	 	<div class="col-xs-7">
			DaCMS <small> {{ $page->title }} </small>
		</div>
		{{-- Check if the user is logged and is admin, moderator or editor --}}
		@if (Auth::check() && in_array(Auth::user()->role(Auth::user()->id), ['admin', 'moderator', 'editor']))
		<div class="col-xs-4 col-xs-push-1">
			<div class="text-right" style="font-size:40%;margin-top:20px">
				<span class="glyphicon glyphicon-pencil"></span> <a href="{{secure_url('/page/edit/'.$page->id)}}">Edit</a>
			</div>
		</div>
		@endif
	</div>
</h1>
@endsection

@section('content')
	<article>{!! $page->content !!}</article>
@endsection