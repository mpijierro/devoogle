@extends('layouts.app')

@section('content')

    @include ('resource.form_version_embedded',  ['form' => $form])

    <div class="panel panel-default">

        <div class="panel-heading"><b>Añadir nuevo formato para: {!! $resource->title() !!}</b></div>

        <div class="panel-body">

            @include('resource.resource_register')

        </div>
    </div>

    @if (isset($versions))
        @include ('resource.versions')
    @endif


@endsection
