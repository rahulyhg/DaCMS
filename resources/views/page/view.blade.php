@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = $page->title;
$layout->robots = $page->robots;
$layout->description = $page->description;
$layout->keywords = $page->keywords;
$layout->canonical = secure_url('/'.$page->slug);
?>
@endsection

@section('content')
	<h1 class="page-header">
		<div class="row">
		 	<div class="col-xs-7">
				DaCMS <small> {{ $page->title }} </small>
			</div>

			{{-- Check if the user is logged and is admin, moderator or editor --}}
			@if ($authUser && $authUser->role > 5)
			<div class="col-xs-4 col-xs-push-1">
				<div class="text-right" style="font-size:40%;margin-top:20px">
					<span class="glyphicon glyphicon-pencil"></span> <a href="{{secure_url('/page/edit/'.$page->id)}}">Edit</a>
				</div>
			</div>
			@endif
		</div>
	</h1>

	<article>{!! $page->content !!}</article>
@endsection