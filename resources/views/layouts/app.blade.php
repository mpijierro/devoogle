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
    <div class="container">

        @include('layouts.menu', ['showCategories' => true])

        <div class="row">

            <div class="col-sm-9 colum-list">

                {!! Notification::showAll() !!}


                <div class="row">

                    <div class="col-xs-12">
                        <form action="{!! route('search-resource') !!}" method="POST" class="" role="search">
                            {{ csrf_field()  }}
                            <div class="input-group div-search">
                                <input type="text" class="form-control" placeholder="Buscar recursos de programación......de momento lo hacemos con un LIKE '%....%' ¯\_(ツ)_/¯ " name="search">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search"
                                                                                     aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @yield('content')
            </div>
            <div class="col-sm-3 sidebar">
                @include('sidebar.sidebar_category')
                @include('sidebar.sidebar_author')
                @include('sidebar.sidebar_event')
                @include('sidebar.sidebar_technology')
                @include('sidebar.sidebar_tag')
                @include('sidebar.sidebar_top')
            </div>
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