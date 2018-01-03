<div class="col-xs-12">
    <a href="{!! $resource->url() !!}" target="_blank" style="font-size: 18px">{!! $resource->title() !!}</a>
    @if ($resource->hasDescription())
        <br>
        {!! $resource->description()  !!}
    @endif
</div>

<div class="col-xs-12" style="margin-top:15px;">

    <!-- Category -->
    <i class="fa fa-folder-open-o" aria-hidden="true"></i>
    <span class="nice"><a
                href="{{route('list-category', $resource->category->slug()) }}">{!! $resource->category->name()  !!}</a></span>


    <!-- Lang -->
    <i class="fa fa-language icon-resource-register" aria-hidden="true"></i> <span
            class="nice">{!! $resource->lang->name() !!}</span>

    <!-- Version -->
    <i class="icon-resource-register" aria-hidden="true" title="Otros formatos disponibles"></i>
    @forelse ($resource->version as $version)
        {{ $loop->first ? '' : ' ' }}

        @include ('layouts.icons_category', ['slug' => $version->category->slug])
        <span class="nice"><a href="{{ $version->url() }}" target="_blank"
                              title="{!! $version->comment() !!}">{{ $version->category->name() }}</a></span>
        <i class="icon-resource-register"></i>
    @empty
        Sin otros formatos.
    @endforelse

    <a href="{!! route('create-version', $resource->uuid()) !!}" title="Añadir nuevo formato" class="icon-resource-register">
        <i class="fa fa-plus-square" aria-hidden="true"></i>
    </a>

    <br><br>
    <!-- Author -->
    <i class="fa fa-users" aria-hidden="true" title="Autor/es"></i>
    @forelse ($resource->author() as $tag)
        {{ $loop->first ? '' : ', ' }}
        <span class="nice"><a href="{{route('list-tag', $tag->slug)}}">{{ $tag->name }}</a></span>
    @empty
        -
    @endforelse

<!-- Event -->
    <i class="fa fa-map-signs icon-resource-register" aria-hidden="true" title="Evento"></i>
    @forelse ($resource->event() as $tag)
        {{ $loop->first ? '' : ', ' }}
        <span class="nice"><a href="{{route('list-tag', $tag->slug)}}">{{ $tag->name }}</a></span>
    @empty
        -
    @endforelse


<!-- Tag -->
    <i class="fa fa-tags icon-resource-register" aria-hidden="true"></i>
    @forelse ($resource->tagsWithoutType() as $tag)
        {{ $loop->first ? '' : ', ' }}
        <span class="nice"><a href="{{route('list-tag', $tag->slug)}}">{{ $tag->name }}</a></span>
    @empty
        -
    @endforelse


<!-- Adm -->
    @if (isLogged())

        @if ( $resource->canWrite(user()) )
            <br><br>
            <a href="{!! route('edit-resource', $resource->uuid()) !!}">Editar</a>&nbsp;&nbsp;&nbsp;
            <a href="{!! route('delete-resource', $resource->uuid()) !!}">Borrar</a>&nbsp;
        @endif

        @if ( $resource->canCheck())
            <br>
            <a href="{!! route('check-resource', $resource->uuid()) !!}">Marcar como revisado</a>
        @endif

        @if ( isAdmin() )
            <br><a href="{!! route('destroy-resource', $resource->uuid()) !!}">Eliminar</a>&nbsp;
        @endif

    @endif

    <a href="{!! route('mark-favourite', $resource->uuid()) !!}">Marcar como favorito</a>&nbsp;&nbsp;&nbsp;
</div>