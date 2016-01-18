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
                @if ($authUser)
                <li><a href="{{secure_url('/dashboard')}}">Dashboard</a></li>
                <li><a href="{{secure_url('/logout')}}">Logout ({{ $authUser->username }})</a></li>
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