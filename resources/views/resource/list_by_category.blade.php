@extends('layouts.app')

@section('content')

    <div class="row div-title-category">
        <div class="col-xs-12">
            <h1 class="title-category title-tag">
                <i class="fa fa-folder-open " aria-hidden="true"></i> {!! $view->categoryName() !!}
            </h1>
            <span class="text-left description-category">
                {!! $view->descriptionCategory() !!}
            </span>
        </div>
    </div>


    @include('resource.list')

@endsection

