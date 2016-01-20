@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'Update: '.$page->title;
?>
@endsection

@section('assets')
<?php
$s = "$('#deleteBtn').click(function(){window.location = '".secure_url('/page/del/'.$page->id)."';});";
Asset::add(secure_url('/tinymce/4.3.3/tinymce.min.js'), 'header');
Asset::add(secure_url('/js/tinymce.js'), 'header');
Asset::addScript($s, 'ready');
?>
@endsection

@section('content')

<h1 class="page-header">Update: <small><a href="{{secure_url($page->slug)}}">{{$page->title}}</a></small></h1>

{!! Form::open(array('url'=>secure_url('/page/edit/'.$page->id), 'class'=>'form-horizontal')) !!}

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('title', 'Title') !!} {!! Form::text('title', $page->title) !!}
		@if (isset($errors))
			{!! $errors->first('title','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('slug', 'Slug') !!} {!! Form::text('slug', $page->slug) !!}
		@if (isset($errors))
			{!! $errors->first('slug','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('content', 'Content') !!} {!! Form::textarea('content', $page->content) !!}
		@if (isset($errors))
			{!! $errors->first('page_content','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		<p>{!! Form::label('description', 'Description') !!} {!! Form::text('description', $page->description) !!}</p>
		@if (isset($errors))
			{!! $errors->first('description','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		<p>{!! Form::label('keywords', 'Keywords') !!} {!! Form::text('keywords', $page->keywords) !!}</p>
		@if (isset($errors))
			{!! $errors->first('keywords','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('robots', 'Robots') !!}
		{!! Form::select('robots', array('all' => 'all','noindex' => 'noindex','nofollow'=>'nofollow'), $page->robots) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('visible', 'Visible') !!} {!! Form::select('visible', array('1' => 'visible', '0' => 'draft'), $page->visible) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('lang', 'Lang') !!} {!! Form::select('lang', array('en' => 'en', 'bg' => 'bg'), $page->lang) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::submit('Update!', array('class'=>'btn-primary btn', 'type'=>'submit')) !!}
		{!! Form::button('DELETE!', array('class'=>'btn-danger btn', 'type'=>'button', 'id'=>'deleteBtn') ) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection