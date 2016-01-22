@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'DELETE: '.$page->title;
?>
@endsection

@section('content')

<h1 class="page-header">Delete page <small><a href="{{ secure_url('/'.$page->slug) }}">{{$page->title}}</a></small></h1>

{!! Form::open(['url'=>secure_url('page/del/'.$page->id), 'class'=>'form-horizontal']) !!}

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::checkbox('confirm','confirm',false) !!} {!! Form::label('confirm', 'DELETE THIS PAGE!') !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::submit('DELETE!', ['class'=>'submit']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection