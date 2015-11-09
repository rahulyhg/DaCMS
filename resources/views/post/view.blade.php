@extends('layouts.main')

@section('content')
<h2><a href="{{secure_url('/blog/'.$post->slug)}}">{{ $post->title }}</a></h2>
<div class="row">
    <div class="col-xs-7">
        <p class="text-left">
        <span class="glyphicon glyphicon-time"></span> Posted on {{date('Y-m-d H:s', strtotime($post->created_at))}}
        @if (count($post->categories) > 0)
            @define $comma = ""
            in <span class="glyphicon glyphicon-book"></span>
            @foreach ($post->categories as $category)
                {{ $comma }}<a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a>
                @if ($comma == "")
                    @define $comma = ", "
                @endif
            @endforeach
        @endif
        </p>
    </div>
    <div class="col-xs-4 col-xs-push-1">
        <p class=" text-right">by <span class="glyphicon glyphicon-user"></span> <a href="{{secure_url('/user/'.$post->user->id)}}">{{ $post->user->username }}</a></p>
    </div>
</div>
<hr>
<p>{{ $post->content }}</p>
<hr>

<div id="buttons">
    <span class='st_facebook_hcount' displayText='Facebook'></span>
    <span class='st_googleplus_hcount' displayText='Google +'></span>
    <span class='st_twitter_hcount' displayText='Tweet' st_via='RoumenDamianoff'></span>
    <span class='st_linkedin_hcount' displayText='LinkedIn'></span>
    <span class='st_email_hcount' displayText='Email'></span>
</div>

@if($post->isDisqus == 1)
        <div id="disqus_thread">
            <ul id="local_comments">
               <?php /* @foreach ($post->lcomments as $comment)
                <li>
                    <cite>{{ $comment->author_name }}</cite>
                    <div>{{ $comment->body }}</div>
                </li>
                @endforeach */ ?>
            </ul>
        </div>
@endif

@endsection

@section('sidebar')
<!-- Blog Search Well -->
<div class="well">
    <h4>Search</h4>
    <div class="input-group">
        <input type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" type="button">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    <!-- /.input-group -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>Categories</h4>
    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
            @define $c=1
            @foreach ($categories as $category)
            @if ($c % 2 == 0)
            <li><a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a> ({{ count($category->posts) }})
            @endif
            @define $c++
            @endforeach
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-unstyled">
            @define $c=2
            @foreach ($categories as $category)
            @if ($c % 2 == 0)
            <li><a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a> ({{ count($category->posts) }})
            @endif
            @define $c++
            @endforeach
            </ul>
        </div>
    </div>
    <!-- /.row -->
</div>

<!-- Tags -->
<div class="well">
    <h4>Tags</h4>
    <p>...</p>
</div>

<!-- Tags -->
<div class="well">
    <h4>Top 10 Authors</h4>
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-unstyled">
            @foreach ($authors as $author)
             <li><a href="{{secure_url('/users/'.$author->id)}}">{{ $author->username }}</a> ({{ count($author->posts) }})
            @endforeach
            </ul>
        </div>
</div>

@endsection












<?php /*
@extends('layouts.main')

@section('content')
    <section id="widepage">

        <h1>{{ $post->title }}</h1>


        <div class="rounded" style="position:relative">

            <span class="date"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> {{date('d-m-Y', strtotime($post->created))}}</span>

            @if (count($post->tags) > 0)
            <span class="taglist">
                <span class="glyphicon glyphicon-tag" aria-hidden="true"></span>
                @foreach ($post->tags as $tag)
                <a rel="tag nofollow" href="{{ secure_url('tag/'.$tag->slug) }}">{{ $tag->slug }}</a>
                @endforeach
            </span>
            @endif

            <span class="author">
                <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                <a rel="author me" target="_blank" href="https://plus.google.com/+RoumenDamianoff">{{ Lang::get('site.roumen') }}</a>
                <a class="hidden" rel="author me" href="https://plus.google.com/+RoumenDamianoff">by Roumen Damianoff</a>
            </span>

            @if (!(Auth::guest()) && (Auth::user()->role >= 8))
            <span class="edit">
                <a href="{{secure_url('/blog/edit/'.$post->id)}}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
            </span>
            @endif

            {!! $post->content !!}

            <?php if (false) { ?>
            <div style="text-align:center;margin:20px 0 -20px 0;">
                <script type="text/javascript" src="http://rio.bg/affiliate/loader.js"></script>
                <script type="text/javascript">var affiliate = {'name' : 'pazaruvalnik.com'};</script>
                <div id="rioOffersTarget_153"></div>
            </div>
            <?php } ?>

            <div id="buttons">
                <span class='st_facebook_hcount' displayText='Facebook'></span>
                <span class='st_googleplus_hcount' displayText='Google +'></span>
                <span class='st_twitter_hcount' displayText='Tweet' st_via='RoumenDamianoff'></span>
                <span class='st_linkedin_hcount' displayText='LinkedIn'></span>
                <span class='st_email_hcount' displayText='Email'></span>
            </div>
        </div>

        @if($post->comments==1)
        <div id="disqus_thread">
            <ul id="local_comments">
                @foreach ($post->lcomments as $comment)
                <li>
                    <cite>{{ $comment->author_name }}</cite>
                    <div>{{ $comment->body }}</div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

    </section>
@endsection
*/ ?>