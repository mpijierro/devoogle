@extends('layouts.app')

@section('content')

    <h1><i class="fa fa-folder-open " aria-hidden="true"></i> {!! $view->categoryName() !!} </h1>

    @include('resource.list')

@endsection

