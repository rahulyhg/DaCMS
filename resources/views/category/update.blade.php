@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'Update: '.$category->name;
?>
@endsection

@section('assets')
<?php
$s = "$('#deleteBtn').click(function(){window.location = '".secure_url('/category/del/'.$category->id)."';});";
Asset::addScript($s, 'ready');
?>
@endsection

@section('content')

<h1 class="page-header">Update: <small><a href="{{ secure_url('/category/'.$category->slug)}}">{{$category->name}}</a></small></h1>

{!! Form::open(['url'=>secure_url('/category/edit/'.$category->id), 'class'=>'form-horizontal']) !!}

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('name', 'Name') !!} {!! Form::text('name', $category->name) !!}
		@if (isset($errors))
			{!! $errors->first('name','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('slug', 'Slug') !!} {!! Form::text('slug', $category->slug) !!}
		@if (isset($errors))
			{!! $errors->first('slug','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::submit('Update!', ['class'=>'btn-primary btn', 'type'=>'submit']) !!}
		{!! Form::button('DELETE!', ['class'=>'btn-danger btn', 'type'=>'button', 'id'=>'deleteBtn'] ) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection