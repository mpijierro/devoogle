@forelse ($resources as $resource)

    <div class="col-xs-12" style="border:1px solid lightgray; margin-bottom: 15px">
        @include('resource.resource_register',   ['resource' => $resource])
    </div>

@empty
    No tenemos recursos aquí por ahora.
@endforelse



@if (isset($paginator))
    <div class="col-xs-12">
        {{ $paginator }}
    </div>
@endif