<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: left;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                    @endauth
        </div>
    @endif

    <div class="content">

        <div class="title m-b-md">
            Devoogle
        </div>

        <div clss="title -m-b-md">
            @include('resource.form_search')
        </div>


        <div class="title m-b-md">
            Categoría <b>{!! $view->categoryName() !!}</b>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @foreach ($view->foundResources() as $resource)

                    @include('resource.resource_register',   ['resource' => $resource]);

                @endforeach
            </div>
        </div>

        <div class="row">

            <div class="col-xs-12">
                {{ $view->paginator() }}
            </div>

        </div>


        <div class="links">
            <a href="{!! route('create-resource') !!}">Nuevo</a>
        </div>
    </div>
</div>
</body>
</html>