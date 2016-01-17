@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'Update: '.$post->title;
?>
@endsection

@section('assets')
<?php
$s = "$('#deleteBtn').click(function(){window.location = '".secure_url('/blog/del/'.$post->id)."';})";
Asset::add(secure_url('/tinymce/4.3.3/tinymce.min.js'), 'header');
Asset::add(secure_url('/js/tinymce.js'), 'header');
Asset::addScript($s,'ready');
?>
@endsection

@section('content')

<h1 class="page-header">Update: <small><a href="{{secure_url('blog/'.$post->slug)}}">{{$post->title}}</a></small></h1>

{!! Form::open(array('url'=>secure_url('/blog/edit/'.$post->id), 'class'=>'form-horizontal')) !!}

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('title', 'Title') !!} {!! Form::text('title', $post->title) !!}
		@if (isset($errors))
			{!! $errors->first('title','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('slug', 'Slug') !!} {!! Form::text('slug', $post->slug) !!}
		@if (isset($errors))
			{!! $errors->first('slug','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('post_content', 'Content') !!} {!! Form::textarea('post_content', $post->content) !!}
		@if (isset($errors))
			{!! $errors->first('page_content','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('resume', 'Resume') !!} {!! Form::textarea('resume', $post->resume) !!}
		@if (isset($errors))
			{!! $errors->first('resume','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('description', 'Description') !!} {!! Form::text('description', $post->description) !!}
		@if (isset($errors))
			{!! $errors->first('description','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('keywords', 'Keywords') !!} {!! Form::text('keywords', $post->keywords) !!}
		@if (isset($errors))
			{!! $errors->first('keywords','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('robots', 'Robots') !!}
			{!! Form::select('robots', array('all' => 'all', 'noindex' => 'noindex', 'nofollow'=>'nofollow'), $post->robots) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('hl', 'hl') !!} {!! Form::select('hl', array('0' => 'Off', '1' => 'On'), $post->hl) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('comments', 'Comments') !!} {!! Form::select('comments', array('1' => 'On', '2' => 'Off'), $post->comments) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('visible', 'Visible') !!} {!! Form::select('visible', array('1' => 'visible', '0' => 'draft'), $post->visible) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('lang', 'Lang') !!} {!! Form::select('lang', array('en' => 'en', 'bg' => 'bg'), $post->lang) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::submit('Update!',array('class'=>'btn-primary btn', 'type'=>'submit')) !!}
			{!! Form::button('DELETE!', array('class'=>'btn-danger btn', 'type'=>'button', 'id'=>'deleteBtn') ) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection