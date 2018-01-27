@extends('layouts.app')

@section('content')


    <h1 style="float:left;">
        <i class="fa fa-folder-open " aria-hidden="true"></i> {!! $view->categoryName() !!}s
        <span class="description-category">{!! $view->descriptionCategory() !!}</span>
    </h1>


    <div class="row"></div>

    @include('resource.list')

@endsection

