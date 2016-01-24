@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'Update: '.$user->username;
?>
@endsection

@section('assets')
<?php
$s = "$('#deleteBtn').click(function(){window.location = '".secure_url('/user/del/'.$user->id)."';});";
Asset::addScript($s, 'ready');
?>
@endsection

@section('content')

<h1 class="page-header">Update user: <small><a href="{{ secure_url('/user/'.$user->id)}}">{{$user->username}}</a></small></h1>

{!! Form::open(['url'=>secure_url('/user/edit/'.$user->id), 'class'=>'form-horizontal']) !!}

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
		{!! Form::label('role', 'Role') !!}
		{!! Form::select('role', ['1'=>'User','6'=>'Editor','7'=>'Moderator','8'=>'Admin'], $user->role) !!}
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