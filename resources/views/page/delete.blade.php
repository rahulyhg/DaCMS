@extends('layouts.main')

@section('header')
<h1 class="page-header">Delete page <small><a href="{{ secure_url('/'.$page->slug) }}">{{$page->title}}</a></small></h1>
@endsection

@section('content')

{!! Form::open(array('url'=>secure_url('page/del/'.$page->id), 'class'=>'form-horizontal')) !!}

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::checkbox('confirm','confirm',false) !!} {!! Form::label('confirm', 'DELETE THIS PAGE!') !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::submit('DELETE!', array('class'=>'submit')) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection