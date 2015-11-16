@extends('layouts.main')

@section('header')
<h1 class="page-header">Create page</h1>
@endsection

@section('content')

{!! Form::open(array('url'=>secure_url('/page/add'), 'class'=>'form-horizontal')) !!}

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
			{!! Form::label('page_content', 'Content') !!} {!! Form::textarea('page_content', Input::get('content')) !!}
		@if (isset($errors))
			{!! $errors->first('page_content','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
				{!! Form::label('lang', 'Lang') !!} {!! Form::select('lang', array('en'=>'en','bg'=>'bg'), Input::get('lang')) !!}
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
				{!! Form::label('robots', 'Robots') !!} {!! Form::select('robots', array('all' => 'all', 'noindex' => 'noindex', 'nofollow'=>'nofollow'), 		Input::get('robots')) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::label('visible', 'Visible') !!} {!! Form::select('visible', array('1' => 'visible', '0' => 'draft'), Input::get('visible		')) !!}
		</div>
	</div>

	<div class="form-group">
			<div class="col-sm-8">
			{!! Form::submit('Create!',array('class'=>'submit		')) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection