@extends('layouts.app')

@section('content')
    <div class="row" >
        <div class="col-xs-12">
            <h3 class="text-left description-category">
                <b>Devoogle</b> cuenta actualmente con <b>{{$total}}</b> recursos disponibles.
            </h3>
        </div>
    </div>

    @include('resource.list')

@endsection