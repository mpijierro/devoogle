@forelse ($resources as $resource)
    <div class="one-register">
        @include('resource.resource_register',   ['resource' => $resource])
    </div>

@empty
    <div class="row">
        <div class="col-xs-12 clearfix">
            Aún no tenemos recursos aquí, anímate y añade uno.
        </div>
    </div>

@endforelse

@if (isset($paginator))
    <div class="row">
        <div class="col-xs-12" align="center">
            {{ $paginator }}
        </div>
    </div>
@endif