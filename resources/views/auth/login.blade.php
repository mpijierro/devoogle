@extends('layouts.app_without_sidebar')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><b>Acceder a Devoogle</b></div>

        <div class="panel-body">


            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Contraseña</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuerdame
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">Acceder</button>
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    </div>
                    <div class="col-md-8 col-md-offset-4 text-left" style="margin-top:20px;">
                        <a href="{{ route('register') }}">
                            ¿No tienes cuenta? regístrate ahora.
                        </a>
                    </div>
                    <div class="row" style="margin-top:50px">
                        <div class="col-md-6 col-md-offset-4">
                            <a href="{{route('social-redirect', 'google')}}" class="btn btn-block btn-social btn-google">
                                <span class="fa fa-google"></span> Entra con tu cuenta de Google
                            </a>

                            <a href="{{route('social-redirect', 'twitter')}}" class="btn btn-block btn-social btn-twitter">
                                <span class="fa fa-twitter"></span> Entra con tu cuenta de Twitter
                            </a>

                            <a href="{{route('social-redirect', 'github')}}" class="btn btn-block btn-social btn-github">
                                <span class="fa fa-github"></span> Entra con tu cuenta de Github
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>


    </div>

@endsection
