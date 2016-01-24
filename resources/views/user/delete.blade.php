@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'DELETE: '.$user->username;
?>
@endsection

@section('content')

<h1 class="page-header">Delete user: <small><a href="{{ secure_url('/user/'.$user->id) }}">{{$user->username}}</a></small></h1>

{!! Form::open(['url'=>secure_url('user/del/'.$user->id), 'class'=>'form-horizontal']) !!}

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::checkbox('confirm','confirm',false) !!} {!! Form::label('confirm', 'DELETE THIS USER!') !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::submit('DELETE!', ['class'=>'submit']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection