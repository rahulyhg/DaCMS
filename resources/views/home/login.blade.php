@extends('layouts.main')

@section('header')
<h1 class="page-header">DaCMS <small>Login form</small></h1>
@endsection

@section('content')
   <section id="widepage">

   <div id="login" style="padding:50px 0 50px 130px">

   @if ($errors->getMessages())
      <div class="alert alert-danger" style="margin:10px 15px 30px -100px;">
         <p>Error!</p>
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

   </section>
@endsection