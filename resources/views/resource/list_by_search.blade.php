@extends('layouts.app')

@section('content')

    <h1><i class="fa fa-search " aria-hidden="true"></i> {!! $view->searchedText() !!} </h1>
    <span class="text-left description-category">
        Recursos de programación de {!! $view->searchedText() !!}
        <br>
        La búsqueda es un simple <b>LIKE '%...término...%'</b> ¯\_(ツ)_/¯<br>Muy pronto nos ayudará Elasticsearch a obtener mejores resultados.
    </span>

    @include('resource.list')

@endsection
