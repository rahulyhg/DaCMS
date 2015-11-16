@extends('layouts.main')

@section('header')
<h1 class="page-header">Create user</h1>
@endsection

@section('content')

{!! Form::open(array('url'=>secure_url('/user/add'), 'class'=>'form-horizontal')) !!}

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
		{!! Form::label('isActive', 'isActive') !!} {!! Form::select('isActive', array('1' => 'yes', '0' => 'no'), Input::get('isActive')) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('usergroup', 'Usergroup') !!}
		{!! Form::select('usergroup', array('4'=>'users','3'=>'editors','2'=>'moderators','1'=>'admins'), Input::get('usergroup')) !!}
		</div>
	</div>

	<div class="form-group">
			<div class="col-sm-8">
			{!! Form::submit('Create!', array('class'=>'submit')) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection