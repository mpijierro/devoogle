@extends('layouts.app')

@section('content')

    <h1><i class="fa fa-search " aria-hidden="true"></i> {!! $view->searchedText() !!} </h1>
    <span class="text-left description-category">
        Recursos de programación de {!! $view->searchedText() !!}
    </span>

    @include('resource.list')

@endsection
