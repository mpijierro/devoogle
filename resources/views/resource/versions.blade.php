@if ($versions->count())

    <div class="panel panel-default">
        <div class="panel-heading">{!! $resource->title() !!} en otros formatos</div>
        <div class="panel-body">

            @foreach ($versions as $version)
                <div class="col-xs-12">
                    @include('resource.version_register', ['version' => $version, 'resource' => $resource])
                    <hr/>
                </div>

            @endforeach
        </div>
    </div>

@else
    Este recurso todavía no tiene otros formatos.
@endif