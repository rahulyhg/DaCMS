<!DOCTYPE html>
<html lang="{{$lang}}">
<head>
    @include('layouts.inc.main.header')
</head>
<body>
    <!-- Navigation -->
    @include('layouts.inc.main.navigation')
    <!-- /Navigation -->
    <!-- .container -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- Content -->
                @yield('content')
                <!-- /Content -->
            </div>
            @if ($layout->sidebar)
            <!-- Sidebar -->
            @include('layouts.inc.main.sidebar')
            <!-- ./Sidebar -->
            @endif
        <hr>
        <!-- Footer -->
        @include('layouts.inc.main.footer')
        <!-- /Footer -->
        </div>
    </div>
    <!-- /.container -->
    <script src="https://cdn.roumen.it/repo/jquery/jquery-2.1.4.min.js"></script>
    <script src="https://cdn.roumen.it/repo/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="{{secure_url('js/main.js?')}}"></script>
    {{Asset::js()}}
    {{Asset::scripts('footer')}}
    {{Asset::scripts('ready')}}
</body>
</html>
