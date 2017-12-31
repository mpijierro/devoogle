@extends('layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">{!! $titleForm !!}</div>

        <div class="panel-body">

            {{ Form::model($form->model(), ['url' => $form->action(), 'method'=>'POST', 'class' => 'form-horizontal']) }}

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


            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-md-4 control-label">Título</label>

                <div class="col-md-6">
                    {{ Form::text('title', null, ['class' => 'form-control', 'id' =>'title', 'required', 'autofocus'] ) }}

                    @if ($errors->has('title'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
                <label for="author" class="col-md-4 control-label">Autor/es</label>

                <div class="col-md-6">
                    {{ Form::text('author', null, ['class' => 'form-control', 'id' =>'author', 'autofocus'] ) }}

                    @if ($errors->has('author'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="col-md-4 control-label">Descripción</label>

                <div class="col-md-6">
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'id' =>'description', 'autofocus', 'rows'=>5] ) }}

                    @if ($errors->has('description'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>


            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <label for="category" class="col-md-4 control-label">Formato</label>

                <div class="col-md-6">

                    {{ \Form::select('category_id', $form->categoryOptions(), null,
                                            ['placeholder' => 'Selecciona formato',
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

                    {{ \Form::select('lang_id', $form->langOptions(), null, ['placeholder' => 'Selecciona formato', 'class' => 'form-control', 'required']) }}

                    @if ($errors->has('lang'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('lang') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>


            <div class="form-group{{ $errors->has('tag') ? ' has-error' : '' }}">
                <label for="tag" class="col-md-4 control-label">Etiquetas</label>

                <div class="col-md-6">
                    {{ Form::text('tag', null, ['class' => 'form-control', 'id' =>'tag', 'autofocus'] ) }}

                    @if ($errors->has('tag'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('tag') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        {!! $textActionButton !!}
                    </button>
                </div>
            </div>
            {{ Form::close() }}

        </div>
    </div>

    @if (isset($versions))
        @if ($versions->count())

            <div class="panel panel-default">
                <div class="panel-heading">{!! $resource->title() !!} en otros formatos</div>
                <div class="panel-body">

                    @foreach ($versions as $version)
                        <div class="col-xs-12">
                            @include('resource.version_register', ['version' => $version, 'resource' => $resource])
                            <hr/>
                        </div>

                    @endforeach
                </div>
            </div>

        @endif
    @endif

    @if (isset($formCreateVersion))
        <hr>
        @include ('resource.form_version_embedded',  ['form' => $formCreateVersion])

    @endif

@endsection
