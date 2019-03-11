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

            <div class="col-xs-9 col-sm-8">
                <a href="{{ url('/') }}" title="Devoogle">
                    <img id="logo"
                         class="d-inline-block mr-1"
                         src="{{asset('image/brand/logo/logo_devoogle.png')}}">
                </a>
            </div>
        </div>


        <div class="collapse navbar-collapse" id="app-navbar-collapse">

            <div class="">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form action="{!! route('search-resource') !!}" method="POST" class="navbar-form" role="search">
                            {{ csrf_field()  }}
                            <div class="input-group div-search">
                                <input type="text" class="form-control" placeholder="Buscar recursos..." name="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"
                                                                                     aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </form>
                    </li>

                    @if ($showCategories)
                        <li class="dropdown hidden-sm hidden-md hidden-lg">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                <i class="fa fa-play-circle" aria-hidden="true"></i>
                                Formatos<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($categories as $category)
                                    <li class="format-option-menu">
                                        @include ('layouts.icons_category', ['slug' => $category->slug])
                                        <a href="{!! route('list-category', $category->slug) !!}"
                                           title="Recursos de programación de {!! $category->name() !!}"
                                           class="{!! $category->isSlug($categorySelectedSlug)?'bold':'' !!} icon-category-sidebar link-format-menu">
                                            {!! $category->name() !!}s
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @endif


                    @guest
                        <li><a href="{{ route('login') }}"><i class="fa fa-sign-in" aria-hidden="true"></i> Acceder</a>
                        </li>


                        @else

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false" aria-haspopup="true">
                                    <i class="fa fa-user" aria-hidden="true"></i> {{ Auth::user()->name }} <span
                                            class="caret"></span>
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
                                        <a href="{{route('user-list-viewed')}}">
                                            <i class="fa fa-eye green" aria-hidden="true"></i>
                                            Vistos
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

                            <li>
                                <a href="{!! route('create-resource') !!}" class="btn">
                                    <button type="button" class="btn btn-xs btn-success"><i class="fa fa-plus-square"
                                                                                            aria-hidden="true"></i>
                                        Añadir recurso
                                    </button>
                                </a>
                            </li>
                            @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>