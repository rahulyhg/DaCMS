@extends('layouts.main')

@section('header')
<h1 class="page-header">DaCMS <small>dashboard</small></h1>
@endsection

@section('content')
<div class="row">
    <div class="row">
        <div class="col-xs-7">
        <h3>Personal info:</h3>
        <p><strong>Name:</strong> {{ $user->first_name . ' ' . $user->last_name }}</p>
        <p><strong>Username:</strong> {{ $user->username }}</p>
        <p><strong>Class:</strong> {{ $user->role($user->id) }}</p>
        </div>
    </div>
</div>

<?php var_dump(Auth::user()->role(Auth::user()->id)); ?>

@if ($user->role($user->id) == 'admin')
<div class="row">
    <div class="row">
        <div class="col-xs-7">
        <h3>Admin panel:</h3>
        <p>Admins only..</p>
        </div>
    </div>
</div>
@endif

@if ($user->role($user->id) == 'admin' || $user->role($user->id) == 'moderator')
<div class="row">
    <div class="row">
        <div class="col-xs-7">
        <h3>Moderator panel:</h3>
        <p>Only for admins and moderators</p>
        </div>
    </div>
</div>
@endif

@if ($user->role($user->id) == 'admin' || $user->role($user->id) == 'moderator' || $user->role($user->id) == 'editor')
<div class="row">
    <div class="row">
        <div class="col-xs-7">
        <h3>Editor panel:</h3>
        <p>Only for admins, moderators and editors</p>
        </div>
    </div>
</div>
@endif

@endsection