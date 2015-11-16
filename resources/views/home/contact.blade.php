@extends('layouts.main')

@section('header')
<h1 class="page-header">Contact form</h1>
@endsection

@section('content')

	@if ($errors->getMessages())
	<div class="col-sm-9 text-left">
		<div class="alert alert-danger">
			<strong>Error!</strong> Please, fix the errors below.
			<a class="close" href="#" data-dismiss="alert">×</a>
		</div>
	</div>
	@else
		@if (Session::get('sended') == true)
		<div class="col-sm-9 text-left">
			<div class="alert alert-success">
				<strong>Success!</strong>Your message is sended.
				<a class="close" href="#" data-dismiss="alert">×</a>
			</div>
		</div>
		@endif
	@endif

	{!! Form::open(array('url' => secure_url('contact'), 'class'=>'form-horizontal', 'role'=>'form')) !!}

	@if ($errors->first('name'))
	<div class="form-group error">
		<div class="col-sm-9">
			{!! Form::text('name', Input::old('name'), array('class'=>'form-control error')) !!}
			{!! $errors->first('name','<p class="help-block error">:message</p>') !!}
		</div>
	</div>
	@else
	<div class="form-group">
		<div class="col-sm-9">
			{!! Form::text('name', Input::old('name'), array('class'=>'form-control', 'placeholder'=>'Name')) !!}
		</div>
	</div>
	@endif

	@if ($errors->first('email'))
	<div class="form-group error">
		<div class="col-sm-9">
			{!! Form::text('email', Input::old('email'), array('class'=>'form-control error')) !!}
			{!! $errors->first('email','<p class="help-block error">:message</p>') !!}
		</div>
	</div>
	@else
	<div class="form-group">
		<div class="col-sm-9">
			{!! Form::text('email', Input::old('email'), array('class'=>'form-control','placeholder'=>'E-mail')) !!}
		</div>
	</div>
	@endif

	@if ($errors->first('subject'))
	<div class="form-group error">
		<div class="col-sm-9">
			{!! Form::text('subject', Input::old('subject'),array('class'=>'form-control error')) !!}
			{!! $errors->first('subject','<p class="help-block error">:message</p>') !!}
		</div>
	</div>
	@else
	<div class="form-group">
		<div class="col-sm-9">
			{!! Form::text('subject', Input::old('subject'), array('class'=>'form-control','placeholder'=>'Subject')) !!}
		</div>
	</div>
	@endif

	@if ($errors->first('subject'))
	<div class="form-group error">
		<div class="col-sm-9">
			{!! Form::textarea('message',Input::old('message'),array('rows' => '3'),array('class'=>'input-xlarge error','placeholder'=>'Message')) !!}
			{!! $errors->first('message','<p class="help-block error">:message</p>') !!}
		</div>
	</div>
	@else
	<div class="form-group">
		<div class="col-sm-9">
			{!! Form::textarea('message', Input::old('message'), array('rows' => '3','class'=>'form-control')) !!}
		</div>
	</div>
	@endif

	@if ($errors->first('recaptcha_response_field'))
	<div class="form-group error">
		<div class="col-sm-9 text-center">
		{!! Recaptcha::render()	!!}
		@if (isset($errors))
			{!!$errors->first('recaptcha_response_field','<p class="help-block error">:message</p>')!!}
		@endif
		</div>
	</div>
	@else
	<div class="form-group">
		<div class="col-sm-9 text-center">
		{!! Recaptcha::render() !!}
		</div>
	</div>
	@endif

	@if (Session::get('sended') != true)
	<div class="form-group">
	<div class="col-sm-9 text-left">
		{!! Form::button('Send', array('class'=>'btn-primary btn', 'type'=>'submit')) !!}
		{!! Form::button('Reset', array('class'=>'btn','type'=>'button')) !!}
	</div>
	</div>
	@else
	<div class="form-group">
	<div class="col-sm-9 text-left">
		{!! Form::button('Sended', array('class'=>'btn-primary btn disabled','type'=>'button')) !!}
		{!! Form::button('Reset', array('class'=>'btn','type'=>'button')) !!}
	</div>
	</div>
	@endif

	{!!Form::close()!!}

@endsection