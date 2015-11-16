@extends('layouts.main')

@section('header')
<h1 class="page-header">Delete user <small><a href="{{ secure_url('/'.$user->slug) }}">{{$user->title}}</a></small></h1>
@endsection

@section('content')

{!! Form::open(array('url'=>secure_url('user/del/'.$user->id), 'class'=>'form-horizontal')) !!}

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::checkbox('confirm','confirm',false) !!} {!! Form::label('confirm', 'DELETE THIS USER!') !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::submit('DELETE!', array('class'=>'submit')) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection