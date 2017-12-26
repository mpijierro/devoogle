@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear registro</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('store-media') }}">

                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <label for="title" class="col-md-4 control-label">Título</label>

                                <div class="col-md-6">
                                    {{ Form::text('title', null, ['class' => 'form-control', 'id' =>'email', 'required', 'autofocus'] ) }}

                                    @if ($errors->has('title'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                                <label for="url" class="col-md-4 control-label">Url</label>

                                <div class="col-md-6">
                                    {{ Form::url('url', null, ['class' => 'form-control', 'id' =>'url', 'required'] ) }}

                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                <label for="category" class="col-md-4 control-label">Categoría</label>

                                <div class="col-md-6">

                                    {{ \Form::select('category_id', $form->categoryOptions(), null,
                                                            ['placeholder' => 'Selecciona categoría',
                                                            'class' => 'form-control', 'required']) }}

                                    @if ($errors->has('category'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('lang') ? ' has-error' : '' }}">
                                <label for="lang" class="col-md-4 control-label">Idioma</label>

                                <div class="col-md-6">

                                    {{ \Form::select('lang_id', $form->langOptions(), null, ['placeholder' => 'Selecciona categoría', 'class' => 'form-control', 'required']) }}

                                    @if ($errors->has('lang'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('lang') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Crear
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
