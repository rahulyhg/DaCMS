@extends('layouts.main')

@section('header')
<h1 class="page-header">DaCMS <small>{{ $page->title }}</small></h1>
@endsection

@section('content')
	<article>{!! $page->content !!}</article>
@endsection