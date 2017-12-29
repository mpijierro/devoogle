@foreach ($resources as $resource)

    <div class="col-xs-12" style="border:1px solid lightgray; margin-bottom: 15px">
        @include('resource.resource_register',   ['resource' => $resource])
    </div>

    @if (isset($paginator))
        <div class="col-xs-12">
            {{ $view->paginator() }}
        </div>
    @endif

@endforeach