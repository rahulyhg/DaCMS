@extends('layouts.main')

@section('content')
<h2><a href="{{secure_url('/blog/'.$post->slug)}}">{{ $post->title }}</a></h2>
<div class="row">
    <div class="col-xs-7">
        <p class="text-left">
        <span class="glyphicon glyphicon-time"></span> {{date('d M Y H:s', strtotime($post->created_at))}}
        @if (count($post->categories) > 0)
            <span class="glyphicon glyphicon-book"></span>
            @foreach ($post->categories as $category)
                <a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a>
            @endforeach
        @endif
        @if (count($post->tags) > 0)
            <span class="glyphicon glyphicon-tag"></span>
            @foreach ($post->tags as $tag)
                <a href="{{secure_url('/tag/'.$tag->slug)}}">{{ $tag->name }}</a>
            @endforeach
        @endif
        </p>
    </div>
    <div class="col-xs-4 col-xs-push-1">
        <p class=" text-right"><span class="glyphicon glyphicon-user"></span> <a href="{{secure_url('/user/'.$post->user->id)}}">{{ $post->user->username }}</a></p>
    </div>
</div>
<hr style="margin-top:0px">
<p class="text-justify">{{ $post->content }}</p>
<hr>

<div class="row">

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

</div>
@endsection