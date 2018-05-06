<?php

use Krucas\Notification\Facades\Notification;

?>
        <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @include('layouts.metas')

    @include('layouts.header')
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

                    <li>
                        <a href="{!! route('more-valued') !!}" class="btn">
                            <i class="fa fa-star yellow" aria-hidden="true"></i>
                            Más valorados
                        </a>
                    </li>

                    @guest
                        <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Entrar</a></li>
                        <li><a href="{{ route('register') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Crear cuenta</a></li>

                        @else

                            <li>
                                <a href="{!! route('create-resource') !!}" class="btn">
                                    <i class="fa fa-plus green" aria-hidden="true"></i>
                                    Añadir recurso
                                </a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
                                </a>


                                <ul class="dropdown-menu">

                                    <li>
                                        <a href="{{route('my-resources')}}">
                                            <i class="fa fa-suitcase" aria-hidden="true"></i>
                                            Mis recursos
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{route('user-list-favourite')}}">
                                            <i class="fa fa-heart red" aria-hidden="true"></i>
                                            Mis favoritos
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{route('user-list-later')}}">
                                            <i class="fa fa-clock-o orange" aria-hidden="true"></i>
                                            Para después
                                        </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Salir
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

    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-offset-2 col-sm-8">

                {!! Notification::showAll() !!}


                @yield('content')
            </div>
        </div>
    </div>

    @include('layouts.footer')

</div>

</body>
</html>