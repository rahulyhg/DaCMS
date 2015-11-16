@extends('layouts.main')

@section('header')
<h1 class="user-header">Edit <small><a href="{{secure_url('/user/'.$user->id)}}">{{$user->username}}</a></small></h1>
@endsection

@section('content')

{!! Form::open(array('url'=>secure_url('/user/edit/'.$user->id), 'class'=>'form-horizontal')) !!}

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('username', 'Username') !!} {!! Form::text('username', $user->username) !!}
		@if (isset($errors))
			{!! $errors->first('username','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('email', 'Email') !!} {!! Form::text('email', $user->email) !!}
		@if (isset($errors))
			{!! $errors->first('email','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('first_name', 'First name') !!} {!! Form::text('first_name', $user->first_name) !!}
		@if (isset($errors))
			{!! $errors->first('first_name','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('last_name', 'Last name') !!} {!! Form::text('last_name', $user->last_name) !!}
		@if (isset($errors))
			{!! $errors->first('last_name','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('isActive', 'isActive') !!} {!! Form::select('isActive', array('1' => 'yes', '0' => 'no'), $user->isActive) !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('usergroup', 'Usergroup') !!}
		{!! Form::select('usergroup', array('4'=>'users','3'=>'editors','2'=>'moderators','1'=>'admins'), $user->roleId($user->id)) !!}
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