@extends('layouts.app')

@section('content')

    <h1><i class="fa fa-search " aria-hidden="true"></i> {!! $view->searchedText() !!} </h1>

    @include('resource.list')

@endsection
