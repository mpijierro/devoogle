@extends('layouts.app')

@section('content')

    <div class="row" >
        <div class="col-xs-12">
            <h3 class="text-left description-category">
                <b>Devoogle</b> tiene indexados actualmente <b>{{$total}}</b> recursos relaciones con el desarrollo de software.
            </h3>
        </div>
    </div>

    @include('resource.list')

@endsection