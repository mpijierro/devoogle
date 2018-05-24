@extends('layouts.app')

@section('content')

    <div class="panel panel-default">

        <div class="panel-heading">{!! $titleForm !!}</div>

        <div class="panel-body">

            {{ Form::model($form->model(), ['url' => $form->action(), 'method'=>'POST', 'class' => 'form-horizontal']) }}

            <div class="form-group info-form">
                <label for="" class="col-md-4 control-label"></label>
                <div class="col-md-6">
                    Estos primeros campos son obligatorios, sin ellos será imposible acceder al recurso que vayas a
                    crear.
                </div>
            </div>

            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                <label for="url" class="col-md-4 control-label">Dirección web *</label>

                <div class="col-md-6">
                    {{ Form::url('url', null, ['class' => 'form-control', 'id' =>'url', 'required', 'autofocus'] ) }}

                    @if ($errors->has('url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="title" class="col-md-4 control-label">Título *</label>

                <div class="col-md-6">
                    {{ Form::text('title', null, ['class' => 'form-control', 'id' =>'title', 'required'] ) }}

                    @if ($errors->has('title'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label for="category" class="col-md-4 control-label">Formato *</label>

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

            <div class="form-group info-form">
                <label for="" class="col-md-4 control-label"></label>
                <div class="col-md-6">
                    De aquí para abajo nada es obligatorio pero si rellenas los campos ayudas a mantener los recursos
                    mejor clasificados.
                </div>
            </div>

            <div class="form-group{{ $errors->has('lang_id') ? ' has-error' : '' }}">
                <label for="lang" class="col-md-4 control-label">Idioma</label>

                <div class="col-md-6">

                    {{ \Form::select('lang_id', $form->langOptions(), null, ['class' => 'form-control', 'required']) }}

                    @if ($errors->has('lang_id'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('lang_id') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('published_at') ? ' has-error' : '' }}">
                <label for="lang" class="col-md-4 control-label">Fecha publicación</label>

                <div class="col-md-6">

                    {{ Form::text('published_at', null, ['class' => 'form-control datepicker', 'id' =>'published_at'] ) }}

                    @if ($errors->has('published_at'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('published_at') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            @include('resource.tag_field', ['title' => 'Autor/es', 'key' => \Devoogle\Src\Tag\Model\Tag::TYPE_AUTHOR])

            @include('resource.tag_field', ['title' => 'Evento', 'key' => \Devoogle\Src\Tag\Model\Tag::TYPE_EVENT])

            @include('resource.tag_field', ['title' => 'Lenguaje/Tecnología', 'key' => \Devoogle\Src\Tag\Model\Tag::TYPE_TECHNOLOGY])

            @include('resource.tag_field', ['title' => 'Recursos', 'key' => \Devoogle\Src\Tag\Model\Tag::TYPE_COMMON])

            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                <label for="description" class="col-md-4 control-label">Descripción</label>

                <div class="col-md-6">
                    {{ Form::textarea('description', null, ['class' => 'form-control', 'id' =>'description',  'rows'=>3] ) }}

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

    <script type="text/javascript">
        $(document).ready(function () {

            $('#author').textext({
                plugins: 'tags autocomplete prompt ajax suggestions',
                prompt: 'Buscar...',
                ajax: {
                    url: '{{route('input-tag', \Devoogle\Src\Tag\Model\Tag::TYPE_AUTHOR)}}',
                    dataType: 'json',
                    cacheResults: false
                }
            });

                    @if ($form->repopulateTagField(\Devoogle\Src\Tag\Model\Tag::TYPE_AUTHOR))

            var strTagField = "{{$form->populateTagField(\Devoogle\Src\Tag\Model\Tag::TYPE_AUTHOR)}}";

            var strTagFieldInArray = strTagField.split(',');

            $('#author').val('');
            $('#author').textext()[0].tags().addTags(strTagFieldInArray);

            @endif


            $('#technology').textext({
                plugins: 'tags autocomplete prompt ajax suggestions',
                prompt: 'Buscar...',
                ajax: {
                    url: '{{route('input-tag', \Devoogle\Src\Tag\Model\Tag::TYPE_TECHNOLOGY)}}',
                    dataType: 'json',
                    cacheResults: false
                }
            });

                    @if ($form->repopulateTagField(\Devoogle\Src\Tag\Model\Tag::TYPE_TECHNOLOGY))

            var strTagField = "{{$form->populateTagField(\Devoogle\Src\Tag\Model\Tag::TYPE_TECHNOLOGY)}}";

            var strTagFieldInArray = strTagField.split(',');

            $('#technology').val('');
            $('#technology').textext()[0].tags().addTags(strTagFieldInArray);

            @endif


            $('#event').textext({
                plugins: 'tags autocomplete prompt ajax suggestions',
                prompt: 'Buscar...',
                ajax: {
                    url: '{{route('input-tag', \Devoogle\Src\Tag\Model\Tag::TYPE_EVENT)}}',
                    dataType: 'json',
                    cacheResults: false
                }
            });

                    @if ($form->repopulateTagField(\Devoogle\Src\Tag\Model\Tag::TYPE_EVENT))

            var strTagField = "{{$form->populateTagField(\Devoogle\Src\Tag\Model\Tag::TYPE_EVENT)}}";

            var strTagFieldInArray = strTagField.split(',');

            $('#event').val('');
            $('#event').textext()[0].tags().addTags(strTagFieldInArray);

            @endif


            $('#tag').textext({
                plugins: 'tags autocomplete prompt ajax suggestions',
                prompt: 'Buscar...',
                ajax: {
                    url: '{{route('input-tag', \Devoogle\Src\Tag\Model\Tag::TYPE_COMMON)}}',
                    dataType: 'json',
                    cacheResults: false
                }
            });

                    @if ($form->repopulateTagField(\Devoogle\Src\Tag\Model\Tag::TYPE_COMMON))

            var strTagField = "{{$form->populateTagField(\Devoogle\Src\Tag\Model\Tag::TYPE_COMMON)}}";

            var strTagFieldInArray = strTagField.split(',');

            $('#tag').val('');
            $('#tag').textext()[0].tags().addTags(strTagFieldInArray);

            @endif


            //$('#temp').textext()[0].tags().addTags(["author 1","author 2"]);
        });
    </script>

@endsection
