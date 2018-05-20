@forelse ($resources as $resource)
    <div class="one-register">
        @include('resource.resource_register',   ['resource' => $resource])
    </div>

@empty
    <div class="row row-empty-list">
        <div class="col-xs-12">
            Este listado aún no tiene recursos para mostrar. Anímate y sé el primero en hacerlo.
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