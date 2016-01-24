@extends('layouts.main')

@section('meta')
<?php
// meta tags
$layout->title = 'DELETE: '.$category->name;
?>
@endsection

@section('content')

<h1 class="page-header">Category <small><a href="{{ secure_url('/category/'.$category->slug) }}">{{$category->name}}</a></small></h1>

{!! Form::open(['url'=>secure_url('category/del/'.$category->id), 'class'=>'form-horizontal']) !!}

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::checkbox('confirm','confirm',false) !!} {!! Form::label('confirm', 'DELETE THIS CATEGORY!') !!}
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-8">
			{!! Form::submit('DELETE!', ['class'=>'submit']) !!}
		</div>
	</div>

{!! Form::close() !!}

@endsection