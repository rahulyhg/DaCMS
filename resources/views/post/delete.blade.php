@extends('layouts.main')

@section('header')
<h1 class="page-header">Delete post <small><a href="{{ secure_url('/blog/'.$post->slug) }}">{{$post->title}}</a></small></h1>
@endsection

@section('content')

{!! Form::open(array('url'=>secure_url('blog/del/'.$post->id), 'class'=>'form-horizontal')) !!}

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::checkbox('confirm','confirm',false) !!} {!! Form::label('confirm', 'DELETE THIS POST!') !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::submit('DELETE!', array('class'=>'submit')) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection