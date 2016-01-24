@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'DELETE: '.$tag->name;
?>
@endsection

@section('content')

<h1 class="page-header">tag <small><a href="{{ secure_url('/tag/'.$tag->slug) }}">{{$tag->name}}</a></small></h1>

{!! Form::open(['url'=>secure_url('tag/del/'.$tag->id), 'class'=>'form-horizontal']) !!}

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::checkbox('confirm','confirm',false) !!} {!! Form::label('confirm', 'DELETE THIS TAG!') !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::submit('DELETE!', ['class'=>'submit']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection