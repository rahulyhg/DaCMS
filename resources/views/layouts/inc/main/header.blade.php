<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
@yield('meta')
<meta name="description" content="{{$layout->description}}"/>
<meta name="keywords" content="{{$layout->keywords}}"/>
<meta name="robots" content="{{$layout->robots}}"/>
<meta name="author" content="DaCMS.co"/>
<link rel="canonical" href="{{$layout->canonical}}"/>
<link rel="alternate" hreflang="{{$lang}}" type="application/rss+xml" title="RSS Feed" href="{{secure_url('feed')}}" />
<link rel="stylesheet" type="text/css" href="https://cdn.roumen.it/repo/bootstrap/3.3.5/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="{{secure_url('css/blog.css?')}}" />
@yield('assets')
{{Asset::css()}}
{{Asset::js('header')}}
{{Asset::scripts('header')}}
<!--[if lt IE 9]>
<script src="https://cdn.roumen.it/repo/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://cdn.roumen.it/repo/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<title>{{$layout->title.' | '.Config::get('app.domain')}}</title>