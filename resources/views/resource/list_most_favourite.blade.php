@extends('layouts.app')

@section('content')

    <h1><i class="fa fa-star" aria-hidden="true"></i> Recursos de programación más valorados</h1>
    <span class="text-left description-category">
        Recursos de programación más valorados por la comunidad
    </span>

    @include('resource.list')

@endsection
