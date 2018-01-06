@forelse ($resources as $resource)

    <div class="col-xs-12 list-register">
        @include('resource.resource_register',   ['resource' => $resource])
    </div>

@empty
    No tenemos recursos aquí.
@endforelse



@if (isset($paginator))
    <div class="col-xs-12">
        {{ $paginator }}
    </div>
@endif