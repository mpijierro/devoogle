@extends('layouts.app')

@section('content')

    @foreach ($view->resource() as $resource)
        <div class="col-xs-12" style="border:1px solid lightgray; margin-bottom: 15px">
            @include('resource.resource_register',   ['resource' => $resource])
        </div>

    @endforeach

@endsection