@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'Create new user';
?>
@endsection

@section('content')

<h1 class="page-header">Create new user</h1>

{!! Form::open(['url'=>secure_url('/user/add'), 'class'=>'form-horizontal']) !!}

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('username', 'Username') !!} {!! Form::text('username', Input::get('username')) !!}
		@if (isset($errors))
			{!! $errors->first('username','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('password', 'Password') !!} {!! Form::text('password', Input::get('password')) !!}
		@if (isset($errors))
			{!! $errors->first('password','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('email', 'Email') !!} {!! Form::text('email', Input::get('email')) !!}
		@if (isset($errors))
			{!! $errors->first('email','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('first_name', 'First name') !!} {!! Form::text('first_name', Input::get('first_name')) !!}
		@if (isset($errors))
			{!! $errors->first('first_name','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('last_name', 'Last name') !!} {!! Form::text('last_name', Input::get('last_name')) !!}
		@if (isset($errors))
			{!! $errors->first('last_name','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('isActive', 'isActive') !!} {!! Form::select('isActive', ['1' => 'yes', '0' => 'no'], Input::get('isActive')) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('role', 'Role') !!}
		{!! Form::select('role', ['1'=>'User','6'=>'Editor','7'=>'Moderator','8'=>'Admin'], Input::get('role')) !!}
		</div>
	</div>

	<div class="form-group">
			<div class="col-sm-8">
			{!! Form::submit('Create!', ['class'=>'submit']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection