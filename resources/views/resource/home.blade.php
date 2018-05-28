@extends('layouts.app')

@section('content')

    <h1><i class="fa fa-caret-down" aria-hidden="true"></i> Es momento de aprender...</h1>
    <span class="text-left description-category">
        Listado con los últimos recursos de programación añadidos a una biblioteca con <b>{{$total}}</b> recursos disponibles.
    </span>

    @include('resource.list')

@endsection