<!doctype html>
<html>
<head>
    @include('head')
</head>
<body>

<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Navigasi</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{action('DashboardController@index')}}">KUIS ONLINE</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                @if (Sentry::getUser()->hasAccess('admin'))
                <li class="dropdown {{Request::is('soals*') ? 'active' : ''}}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Soal <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{action('SoalsController@index')}}">Daftar Soal</a></li>
                        <li><a href="{{action('SoalsController@create')}}">Tambah Soal</a></li>
                    </ul>
                </li>
                <li class="dropdown {{Request::is('lembars*') ? 'active' : ''}}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Kuis <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{action('LembarsController@index')}}">Daftar Kuis</a></li>
                        <li><a href="{{action('LembarsController@create')}}">Tambah Kuis</a></li>
                    </ul>
                </li>
                @endif
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="active dropdown">
                    <a data-toggle="dropdown" href="#">{{Sentry::getUser()->email}}<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{URL::route('logout')}}">Logout</a></li>
                    </ul>

                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>

<div class="container">
    @yield('content')

</div>
<!-- /container -->


@include('footer')
</body>
</html>