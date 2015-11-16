@extends('layouts.main')

@section('header')
<h1 class="page-header">Tag page <small><a href="{{ secure_url('/tag/'.$tag->slug) }}">{{$tag->name}}</a></small></h1>
@endsection

@section('content')

{!! Form::open(array('url'=>secure_url('tag/del/'.$tag->id), 'class'=>'form-horizontal')) !!}

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::checkbox('confirm','confirm',false) !!} {!! Form::label('confirm', 'DELETE THIS TAG!') !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::submit('DELETE!', array('class'=>'submit')) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection