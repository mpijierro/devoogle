@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><b>Crear cuenta en Devoogle</b></div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Nombre</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                    <label for="password-confirm" class="col-md-4 control-label">Confirmar contraseña</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Crear cuenta
                        </button>
                    </div>
                </div>
            </form>

            <div class="row" style="margin-top:100px">
                <div class="col-md-6 col-md-offset-4">
                    <a href="{{route('social-redirect', 'google')}}" class="btn btn-block btn-social btn-google">
                        <span class="fa fa-google"></span> Regístrate con tu cuenta de Google
                    </a>

                    <a href="{{route('social-redirect', 'twitter')}}" class="btn btn-block btn-social btn-twitter">
                        <span class="fa fa-twitter"></span> Regístrate con tu cuenta de Twitter
                    </a>

                    <a href="{{route('social-redirect', 'github')}}" class="btn btn-block btn-social btn-github">
                        <span class="fa fa-github"></span> Regístrate con tu cuenta de Github
                    </a>
                </div>
            </div>

        </div>
    </div>


@endsection
