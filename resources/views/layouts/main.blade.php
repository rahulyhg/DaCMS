<?php

// language
$lang = env('APP_LOCALE');

// meta
if (!isset($meta['title'])) $meta['title']="Homepage";
if (!isset($meta['description'])) $meta['description']="A very simple CMS build with Laravel and Bootstrap.";
if (!isset($meta['keywords'])) $meta['keywords']="dacms, cms, laravel, bootstrap";
if (!isset($meta['robots'])) $meta['robots']="index, follow, noodp, noydir";
if (!isset($meta['canonical'])) $meta['canonical']=env('APP_URL');

$feed = secure_url('feed/en');

// assets
if (!App::environment('local')) { Asset::$secure=true; }

//Asset::setDomain('https://cdn.roumen.it/dacms/');
Asset::addFirst(secure_url('css/blog.css?'));
Asset::addFirst('https://cdn.roumen.it/repo/bootstrap/3.3.1/css/bootstrap.min.css');

Asset::addFirst(secure_url('js/default.js?'));
//Asset::addFirst('https://cdn.roumen.it/repo/snowstorm/snowstorm-min.js');
Asset::addFirst('https://cdn.roumen.it/repo/bootstrap/3.3.1/js/bootstrap.min.js');
Asset::addFirst('https://cdn.roumen.it/repo/jquery/jquery-1.11.2.min.js');

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
    <link rel="alternate" hreflang="{{ $lang }}" type="application/rss+xml" title="RSS Feed" href="{{$feed}}" />

    {{ Asset::css() }}
    {{ Asset::scripts('header') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
                    @if (Auth::check())
                    <li><a href="{{secure_url('/admin')}}">Admin</a></li>
                    <li><a href="{{secure_url('/logout')}}">Logout</a></li>
                    @else
                    <li><a href="{{secure_url('/login')}}">Login</a> </li>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">DaCMS <small>{{$meta['title']}}</small></h1>

                <!-- Content -->
                @yield('content')
                <!-- /Content -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Sidebar -->
                @yield('sidebar')
                <!-- /Sidebar -->

            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-xs-3">
                        <p class="text-left">Copyright &copy; 2015-2016, <a href="{{ env('APP_URL') }}">{{ env('APP_DOMAIN') }}</a>.</p>
                    </div>
                    <div class="col-xs-3 col-xs-push-6">
                        <p class="text-right">Powered by <a href="https://dacms.co">DaCMS</a>.</p>
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
