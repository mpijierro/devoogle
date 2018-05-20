@extends('layouts.app')

@section('content')

    <h1 class="title-tag"><i class="fa fa-tag" aria-hidden="true"></i> {!! $view->tagName() !!}</h1>

    @include('resource.list')

@endsection
