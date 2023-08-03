<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Site Metas -->
<title>@yield('title')</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

@include('client.layout.header')

</head>

<body>

    <div id="wrapper">
        <header class="tech-header header">
            <div class="container-fluid">
                <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
                    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                        data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}">Blog<strong>Car</strong></a>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ '/category/o-to' }}">Ôtô</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ '/category/xe-dien' }}">Xe điện</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ '/category/xe-may' }}">Xe máy</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ '/category/danh-gia-xe' }}">Đánh giá xe</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/lien-he') }}">Liên hệ</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav mr-2">
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-rss"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-android"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="fa fa-apple"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login.client') }}">Login</a>
                            </li>
                            @if (Illuminate\Support\Facades\Auth::check())
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('logout.client') }}">/ Logout</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div><!-- end container-fluid -->
        </header><!-- end market-header -->
        @yield('content')
        @include('client.layout.footer')
        <div class="dmtop">Scroll to Top</div>

    </div><!-- end wrapper -->


    @include('client.layout.script')
</body>

</html>
