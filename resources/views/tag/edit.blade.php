@extends('layouts.main')

@section('header')
<h1 class="page-header">Edit <small><a href="{{ secure_url('/tag/'.$tag->slug)}}">{{$tag->name}}</a></small></h1>
@endsection

@section('content')

{!! Form::open(array('url'=>secure_url('/tag/edit/'.$tag->id), 'class'=>'form-horizontal')) !!}

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('name', 'Name') !!} {!! Form::text('name', $tag->name) !!}
		@if (isset($errors))
			{!! $errors->first('name','<span class="error">:message</span>') !!}
		@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
		{!! Form::label('slug', 'Slug') !!} {!! Form::text('slug', $tag->slug) !!}
		@if (isset($errors))
			{!! $errors->first('slug','<span class="error">:message</span>') !!}
		@endif
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