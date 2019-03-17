<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    @include('layouts.metas')

    @include('layouts.header')


</head>
<body>
<div id="app">
    <div class="container">

        @include('layouts.menu', ['showCategories' => true])

        <div class="row">

            <div class="col-sm-9">

                {!! Krucas\Notification\Facades\Notification::showAll() !!}


                @guest

                    @else
                        <div class="row">
                            <div class="col-xs-12">

                                <a href="{!! route('create-resource') !!}" class="link-format-menu col-xs-6">
                                    <i class="fa fa-plus-square green" aria-hidden="true"></i> Añadir recurso
                                </a>

                                <a href="{{route('my-resources')}}" class="link-format-menu col-xs-6">
                                    <i class="fa fa-suitcase" aria-hidden="true"></i> Mis recursos
                                </a>


                                <a href="{{route('user-list-favourite')}}" class="link-format-menu col-xs-6">
                                    <i class="fa fa-heart red" aria-hidden="true"></i> Mis favoritos
                                </a>


                                <a href="{{route('user-list-later')}}" class="link-format-menu col-xs-6">
                                    <i class="fa fa-clock-o orange" aria-hidden="true"></i> Para después
                                </a>


                                <a href="{{route('user-list-viewed')}}" class="link-format-menu col-xs-6">
                                    <i class="fa fa-eye" aria-hidden="true"></i> Vistos
                                </a>

                                <a href="{{ route('logout') }}"
                                   class="link-format-menu col-xs-6"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out" aria-hidden="true"></i> Salir
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>

                        </div>
                        @endguest


                        <div class="row hidden-sm hidden-md hidden-lg" style="margin-top:15px;">

                            <div class="col-xs-12">
                                <form action="{!! route('search-resource') !!}" method="POST" class="" role="search">
                                    {{ csrf_field()  }}
                                    <div class="input-group div-search">
                                        <input type="text" class="form-control"
                                               placeholder="Buscar recursos de programación..."
                                               name="search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="fa fa-search"
                                                                                             aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="row hidden-sm hidden-md hidden-lg" style="margin-top:10px">
                            <div class="col-xs-12">
                                @foreach ($categories as $category)


                                    <a href="{!! route('list-category', $category->slug) !!}"
                                       title="Recursos de programación de {!! $category->name() !!}"
                                       class="{!! $category->isSlug($categorySelectedSlug)?'bold':'' !!} link-format-menu col-xs-6">
                                        @include ('layouts.icons_category', ['slug' => $category->slug]) {!! $category->name() !!}s
                                    </a>

                                @endforeach

                                @guest
                                    <a href="{{ route('login') }}"
                                       class=" link-format-menu col-xs-6">
                                        <i class="fa fa-sign-in" aria-hidden="true"></i> Acceder
                                    </a>
                                @endguest
                            </div>

                        </div>


                        <div class="row hidden-sm hidden-md hidden-lg" style="margin-top:10px">
                            <div class="col-xs-12">

                                @guest

                                    @else

                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                           aria-expanded="false" aria-haspopup="true">
                                            <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span
                                                    class="caret"></span>
                                        </a>

                                        <a href="{{route('my-resources')}}">
                                            <i class="fa fa-suitcase" aria-hidden="true"></i>
                                            Mis recursos
                                        </a>



                                        <a href="{{route('user-list-favourite')}}">
                                            <i class="fa fa-heart red" aria-hidden="true"></i>
                                            Mis favoritos
                                        </a>



                                        <a href="{{route('user-list-later')}}">
                                            <i class="fa fa-clock-o orange" aria-hidden="true"></i>
                                            Para después
                                        </a>



                                        <a href="{{route('user-list-viewed')}}">
                                            <i class="fa fa-eye green" aria-hidden="true"></i>
                                            Vistos
                                        </a>



                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Salir
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>



                                        <a href="{!! route('create-resource') !!}" class="btn">
                                            <button type="button" class="btn btn-xs btn-success"><i
                                                        class="fa fa-plus-square"
                                                        aria-hidden="true"></i>
                                                Añadir recurso
                                            </button>
                                        </a>

                                        @endguest
                            </div>
                        </div>


                        <hr class="hidden-xs">
                        @yield('content')
            </div>
            <div class="col-sm-3 sidebar">
                @include('sidebar.sidebar_search')
                @include('sidebar.sidebar_category')
                @include('sidebar.sidebar_author')
                @include('sidebar.sidebar_event')
                @include('sidebar.sidebar_technology')
                @include('sidebar.sidebar_tag')
                @include('sidebar.sidebar_top')
            </div>

        </div>

        @include('layouts.footer')

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js"></script>


    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ asset('js/devoogle.js?v=1.1') }}"></script>


</body>
</html>