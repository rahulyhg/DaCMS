@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'Update: '.$tag->name;
?>
@endsection

@section('assets')
<?php
$s = "$('#deleteBtn').click(function(){window.location = '".secure_url('/tag/del/'.$tag->id)."';});";
Asset::addScript($s, 'ready');
?>
@endsection

@section('content')

<h1 class="page-header">Update: <small><a href="{{ secure_url('/tag/'.$tag->slug)}}">{{$tag->name}}</a></small></h1>

{!! Form::open(['url'=>secure_url('/tag/edit/'.$tag->id), 'class'=>'form-horizontal']) !!}

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('name', 'Name') !!} {!! Form::text('name', $tag->name) !!}
		@if (isset($errors))
			{!! $errors->first('name','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('slug', 'Slug') !!} {!! Form::text('slug', $tag->slug) !!}
		@if (isset($errors))
			{!! $errors->first('slug','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::submit('Update!', ['class'=>'btn-primary btn', 'type'=>'submit']) !!}
		{!! Form::button('DELETE!', ['class'=>'btn-danger btn', 'type'=>'button', 'id'=>'deleteBtn']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection