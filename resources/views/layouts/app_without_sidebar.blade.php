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

        @include('layouts.menu', ['showCategories' => false])

        <div class="row">

            <div class="col-xs-12">

                {!! Notification::showAll() !!}


                @yield('content')
            </div>
        </div>
    </div>

    @include('layouts.footer')

</div>

</body>
</html>