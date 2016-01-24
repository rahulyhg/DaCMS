@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'Create new category';
?>
@endsection

@section('content')

<h1 class="page-header">Create category</h1>

{!! Form::open(['url'=>secure_url('/category/add'), 'class'=>'form-horizontal']) !!}

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('name', 'Name') !!} {!! Form::text('name', Input::get('name')) !!}
		@if (isset($errors))
			{!! $errors->first('name','<span class="error">:message</span>') !!}
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
			{!! Form::submit('Create!', ['class'=>'submit']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection