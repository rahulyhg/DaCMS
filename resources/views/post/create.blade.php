@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'Create new post';
?>
@endsection

@section('assets')
<?php
Asset::add(secure_url('/tinymce/4.3.3/tinymce.min.js'), 'header');
Asset::add(secure_url('/js/tinymce.js'), 'header');
?>
@endsection

@section('content')

<h1 class="page-header">Create new post</h1>

{!! Form::open(array('url'=>secure_url('/blog/add'), 'class'=>'form-horizontal')) !!}

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('title', 'Title') !!} {!! Form::text('title', Input::get('title')) !!}
		@if (isset($errors))
			{!! $errors->first('title','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('slug', 'Slug') !!} {!! Form::text('slug', Input::get('slug')) !!}
		@if (isset($errors))
			{!! $errors->first('slug','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('post_content', 'Content') !!} {!! Form::textarea('content', Input::get('content')) !!}
		@if (isset($errors))
			{!! $errors->first('page_content','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('resume', 'Resume') !!} {!! Form::textarea('resume', Input::get('resume')) !!}
		@if (isset($errors))
			{!! $errors->first('resume','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('description', 'Description') !!} {!! Form::text('description', Input::get('description')) !!}
		@if (isset($errors))
			{!! $errors->first('description','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('keywords', 'Keywords') !!} {!! Form::text('keywords', Input::get('keywords')) !!}
		@if (isset($errors))
			{!! $errors->first('keywords','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('robots', 'Robots') !!}
			{!! Form::select('robots', array('all' => 'all', 'noindex' => 'noindex', 'nofollow'=>'nofollow'), Input::get('robots')) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('hl', 'hl') !!}
			{!! Form::select('hl', array('0' => 'Off', '1' => 'On'), Input::get('hl')) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('comments', 'Comments') !!}
			{!! Form::select('comments', array('1' => 'On', '0' => 'Off'), Input::get('comments')) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('visible', 'Visible') !!}
			{!! Form::select('visible', array('1' => 'visible', '0' => 'draft'), Input::get('visible')) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('lang', 'Lang') !!}
			{!! Form::select('lang', array('en' => 'en', 'bg' => 'bg'), Input::get('lang')) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::submit('Create!',array('class'=>'btn-primary btn', 'type'=>'submit')) !!}
		</div>
	</div>

	<input type="hidden" name="user_id" value="{{$authUser->id}}">

{!! Form::close() !!}

@endsection