@extends('layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">{!! $titleForm !!}</div>

        <div class="panel-body">

            {{ Form::model($form->model(), ['url' => $form->action(), 'method'=>'POST', 'class' => 'form-horizontal']) }}

            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                <label for="url" class="col-md-4 control-label">Dirección web</label>

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
                    {{ Form::text('author', null, ['class' => 'form-control typeahead', 'id' =>'author',"data-role"=>"tagsinput" , 'autofocus'] ) }}

                    @if ($errors->has('author'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('author') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label>Add Tags:</label><br/>
                <input type="text" name="tags" placeholder="Autores" class="typeahead tm-input form-control tm-input-info"/>
            </div>


            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label for="category" class="col-md-4 control-label">Formato</label>

                <div class="col-md-6">

                    {{ \Form::select('category_id', $form->categoryOptions(), null,
                                            ['placeholder' => 'Selecciona formato',
                                            'class' => 'form-control', 'required']) }}

                    @if ($errors->has('category_id'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('category_id') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('lang_id') ? ' has-error' : '' }}">
                <label for="lang" class="col-md-4 control-label">Idioma</label>

                <div class="col-md-6">

                    {{ \Form::select('lang_id', $form->langOptions(), null, ['placeholder' => 'Selecciona formato', 'class' => 'form-control', 'required']) }}

                    @if ($errors->has('lang_id'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('event') ? ' has-error' : '' }}">
                <label for="event" class="col-md-4 control-label">Evento</label>

                <div class="col-md-6">
                    {{ Form::text('event', null, ['class' => 'form-control', 'id' =>'event', 'autofocus'] ) }}

                    @if ($errors->has('event'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('event') }}</strong>
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

            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="col-md-4 control-label">Descripción</label>

                <div class="col-md-6">
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'id' =>'description', 'autofocus', 'rows'=>3] ) }}

                    @if ($errors->has('description'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
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

            @if (isset($uuid))
                <div class="col-xs-12 ">
                    <a href="{!! route('create-version', $uuid) !!}" title="Añadir nuevo formato" class="icon-resource-register">
                        <i class="fa fa-plus-square" aria-hidden="true"></i> Añadir un nuevo formato
                    </a>
                </div>
            @endif

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


@endsection
