@extends('layouts.app')

@section('content')

    <h1 class="title-tag"><i class="fa fa-tag" aria-hidden="true"></i> {!! $view->tagName() !!}</h1>

    <span class="text-left description-category">
        Recursos de programación de {!! $view->tagName() !!}
    </span>

    @include('resource.list')

@endsection
