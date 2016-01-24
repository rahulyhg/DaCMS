@extends('layouts.main')

@section('meta')
<?php
// meta users
$layout->title = 'Login form';
$layout->robots = 'noindex';
$layout->canonical = secure_url('login')
?>
@endsection

@section('content')

<h1 class="page-header">DaCMS <small>Login form</small></h1>

<div class="row">
   @if ($errors->getMessages())
      <div class="alert alert-danger">
         <strong>Error!</strong> Please, fix the errors below.
         <a class="close" href="#" data-dismiss="alert">×</a>
      </div>
   @endif

   {!! Form::open(array('url' => secure_url('login'), 'class'=>'form-horizontal', 'role'=>'form')) !!}

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
         {!! Form::text('email', Input::old('email'), array('class'=>'form-control','placeholder'=>'username')) !!}
      </div>
   </div>
   @endif

   @if ($errors->first('password'))
   <div class="form-group error">
      <div class="col-sm-9">
         {!! Form::password('password', array('class'=>'form-control error')) !!}
         {!! $errors->first('password','<p class="help-block error">:message</p>') !!}
      </div>
   </div>
   @else
   <div class="form-group">
      <div class="col-sm-9">
         {!! Form::password('password', array('class'=>'form-control', 'placeholder'=>'password')) !!}
      </div>
   </div>
   @endif

   <div class="form-group">
      <div class="col-sm-3">
         {!! Form::checkbox('remember', 'Remember me', 'remember') !!}
         {!! Form::label('remember', 'remember me', array('class'=>'control-label')) !!}
      </div>
   </div>

   @if ($errors->first('g-recaptcha-response'))
   <div class="form-group error">
      <div class="col-sm-9">
      {!! Recaptcha::render() !!}
      @if (isset($errors))
         {!!$errors->first('recaptcha_response_field','<p class="help-block error">:message</p>')!!}
      @endif
      </div>
   </div>
   @else
   <div class="form-group">
      <div class="col-sm-9">
      {!! Recaptcha::render() !!}
      </div>
   </div>
   @endif

   <div class="form-group">
   <div class="col-sm-9">
      {!! Form::button('Login', array('class'=>'btn-primary btn', 'type'=>'submit')) !!}
      {!! Form::button('Reset', array('class'=>'btn','type'=>'button')) !!}
   </div>
   </div>

   {!!Form::close()!!}
   </div>

@endsection