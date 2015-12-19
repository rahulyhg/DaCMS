<?php

// language
$lang = Config::get('app.locale');

// meta
if (!isset($meta['title'])) $meta['title']="Homepage";
if (!isset($meta['description'])) $meta['description']="A very simple CMS build with Laravel and Bootstrap.";
if (!isset($meta['keywords'])) $meta['keywords']="dacms, cms, laravel, bootstrap";
if (!isset($meta['robots'])) $meta['robots']="index, follow, noodp, noydir";
if (!isset($meta['canonical'])) $meta['canonical']=Config::get('app.url');

// assets
//if (!App::environment('local')) { Asset::$secure=true; }

Asset::add('https://cdn.roumen.it/repo/bootstrap/*/css/bootstrap.min.css');
Asset::add(secure_url('css/blog.css?'));
Asset::add('https://cdn.roumen.it/repo/jquery/jquery-*.min.js');
Asset::add('https://cdn.roumen.it/repo/bootstrap/*/js/bootstrap.min.js');
Asset::add(secure_url('js/main.js?'));
Asset::add('https://cdn.roumen.it/repo/snowstorm/snowstorm-min.js');

// data
// TODO caching
$tags = \App\Tag::get();
$categories = \App\Category::get();
$authors = \App\User::get();
?>
<!DOCTYPE html>
<html lang="{{$lang}}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="{{$meta['description']}}"/>
    <meta name="keywords" content="{{$meta['keywords']}}"/>
    <meta name="robots" content="{{$meta['robots']}}"/>

    <meta name="author" content="Roumen Damianoff"/>

    <link rel="canonical" href="{{$meta['canonical']}}"/>
    <link rel="alternate" hreflang="{{ $lang }}" type="application/rss+xml" title="RSS Feed" href="{{secure_url('feed')}}" />

    {{ Asset::css() }}
    {{ Asset::scripts('header') }}

    <!--[if lt IE 9]>
        <script src="https://cdn.roumen.it/repo/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://cdn.roumen.it/repo/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <title>{{$meta['title']}}</title>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{secure_url('/')}}">DaCMS</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{secure_url('/')}}">Home</a></li>
                    <li><a href="{{secure_url('/about')}}">About</a></li>
                    <li><a href="{{secure_url('/blog')}}">Blog</a></li>
                    <li><a href="{{secure_url('/contact')}}">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                    <li><a href="{{secure_url('/dashboard')}}">Dashboard</a></li>
                    <li><a href="{{secure_url('/logout')}}">Logout ({{ Auth::user()->username }})</a></li>
                    @else
                    <li><a href="{{secure_url('/login')}}">Login</a> </li>
                    @endif
                    </span>
                </ul>
            </div>

            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <!-- Header -->
                @yield('header')
                <!-- ./Header -->

                <!-- Content -->
                @yield('content')
                <!-- /Content -->

            </div>

            <!-- Sidebar -->
            <div class="col-md-4">

                <!-- Search -->
                <div class="well">
                    <h4>Search</h4>
                    <div class="input-group">
                        <form id="searchForm" method="post" action="{{ secure_url('search') }}">
                            <input type="text" name="s" id="s" class="form-control">
                            {!! Form::token() !!}
                        </form>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" form="searchForm">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                </div>

                <!-- Categories -->
                <div class="well">
                    <h4>Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                            <?php $c=1; ?>
                            @foreach ($categories as $category)
                            @if ($c % 2 == 0)
                            <li><a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a> ({{ count($category->posts) }})
                            @endif
                            <?php $c++; ?>
                            @endforeach
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                            <?php $c=2; ?>
                            @foreach ($categories as $category)
                            @if ($c % 2 == 0)
                            <li><a href="{{secure_url('/category/'.$category->slug)}}">{{ $category->name }}</a> ({{ count($category->posts) }})
                            @endif
                            <?php $c++; ?>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Tags -->
                <div class="well">
                    <h4>Tags</h4>
                    <?php

                    $maximum = 0;

                    foreach ($tags as $tag)
                    {
                        if (count($tag->posts) > $maximum)
                        {
                            $maximum = count($tag->posts);
                        }
                    }

                    foreach ($tags as $tag)
                    {
                        if (count($tag->posts) > 0)
                        {

                            $percent = floor((count($tag->posts) / $maximum) * 100);

                             // determine the class based on the percentage
                             if ($percent < 20):
                               $class = 'smallest';
                             elseif ($percent >= 20 and $percent < 40):
                               $class = 'small';
                             elseif ($percent >= 40 and $percent < 60):
                               $class = 'medium';
                             elseif ($percent >= 60 and $percent < 80):
                               $class = 'large';
                             else:
                             $class = 'largest';
                             endif;

                            echo '<a class="'.$class.'" href="'.secure_url("/tag/".$tag->slug).'">'.$tag->slug.'</a> ';
                        }
                    }
                    ?>
                </div>

                <!-- Authors -->
                <div class="well">
                    <h4>Top 10 Authors</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                            @foreach ($authors as $author)
                             <li><a href="{{secure_url('/user/'.$author->id)}}">{{ $author->username }}</a> ({{ count($author->posts) }})
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                @yield('sidebar')

            </div>
            <!-- /Sidebar -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-xs-5">
                        <p class="text-left">
                            Copyright &copy; 2015-2016, <a href="{{ Config::get('app.url') }}">{{ Config::get('app.domain') }}</a>.
                            Powered by <a rel="self" href="https://dacms.co">DaCMS</a> and <a href="https://cdn.roumen.it/" target="_blank" title="Content Delivery Network">CDN</a>.
                            </p>
                    </div>
                    <div class="col-xs-3 col-xs-push-4">
                        <p class="text-right">
                            Created by <a href="https://roumen.it" target="_blank" title="Roumen Damianoff" rel="webmaster">Roumen</a>.
                        </p>
                    </div>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    {{ Asset::js() }}
    {{ Asset::scripts('footer') }}
    {{ Asset::scripts('ready') }}
</body>

</html>
