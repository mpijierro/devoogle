<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @include('layouts.metas')


    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>

    <script src="{{ asset('js/app.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

    @if (isset($loadTagManager))

        <link rel="stylesheet" href="/css/textext.core.css" type="text/css"/>
        <link rel="stylesheet" href="/css/textext.plugin.tags.css" type="text/css"/>
        <link rel="stylesheet" href="/css/textext.plugin.autocomplete.css" type="text/css"/>
        <link rel="stylesheet" href="/css/textext.plugin.prompt.css" type="text/css"/>
        <script src="/js/textext.core.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/textext.plugin.tags.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/textext.plugin.autocomplete.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/textext.plugin.suggestions.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/textext.plugin.prompt.js" type="text/javascript" charset="utf-8"></script>
        <script src="/js/textext.plugin.ajax.js" type="text/javascript" charset="utf-8"></script>
    @endif

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>


            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    &nbsp;
                </ul>

                <div class="col-sm-3 col-md-3">
                    <form action="{!! route('search-resource') !!}" method="POST" class="navbar-form" role="search">
                        {{ csrf_field()  }}
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar..." name="search">
                            <div class="input-group-btn">
                                <button class="btn btn-default" type="submit"><i class="fa fa-search"
                                                                                 aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </form>
                </div>

                <ul class="nav navbar-nav navbar-right">

                    @guest
                        <li><a href="{{ route('login') }}">Entrar</a></li>
                        <li><a href="{{ route('register') }}">Crear cuenta</a></li>

                        @else

                            <li>
                                <a href="{!! route('create-resource') !!}" class="btn">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Añadir recurso
                                </a>
                            </li>

                            <li>
                                <a href="{{route('user-list-favourite')}}">
                                    <i class="fa fa-heart red" aria-hidden="true"></i>
                                    Favoritos
                                </a>
                            </li>

                            <li>
                                <a href="{{route('user-list-later')}}">
                                    <i class="fa fa-clock-o orange" aria-hidden="true"></i>
                                    Para después
                                </a>
                            </li>



                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                </ul>
                            </li>
                            @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">

            <div class="col-sm-2 sidebar">
                @include('sidebar.sidebar_category')
                @include('sidebar.sidebar_author')
                @include('sidebar.sidebar_event')
                @include('sidebar.sidebar_technology')
                @include('sidebar.sidebar_tag')
            </div>

            <div class="col-sm-10 ">
                @yield('content')
            </div>
        </div>
    </div>

</div>

</body>
</html>