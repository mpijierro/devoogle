<div class="col-xs-12">
    <div class="row">
        <div class="col-sm-10">
            <a href="{!! $resource->url() !!}" target="_blank" style="font-size: 18px;">{!! $resource->title() !!}</a>
        </div>
        <div class="col-sm-2" align="right">
            @if (isLogged())
                <a href="{!! route('toggle-favourite', $resource->uuid()) !!}">
                    @if($resource->isFavourite())
                        <i class="fa fa-heart fa-sm red" aria-hidden="true" title="Desmarcar como favorito"></i>
                    @else
                        <i class="fa fa-heart fa-sm gray" aria-hidden="true" title="Marcar como favorito"></i>
                    @endif
                </a>&nbsp;&nbsp;&nbsp;
                &nbsp;
                <a href="{!! route('toggle-later', $resource->uuid()) !!}">
                    @if ($resource->isLater())
                        <i class="fa fa-clock-o fa-sm orange" aria-hidden="true" title="Desmarcar para ver después"></i>
                    @else
                        <i class="fa fa-clock-o fa-sm gray" aria-hidden="true" title="Marcar para ver después"></i>
                    @endif
                </a>&nbsp;&nbsp;
                &nbsp;
            @endif
        </div>
    </div>
    @if ($resource->hasDescription())
        <div class="row">
            <div class="col-xs-12">
                {!! $resource->description()  !!}
            </div>
        </div>

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


<!-- Technology / Language -->
    <i class="fa fa-microchip icon-resource-register" aria-hidden="true" title="Tecnología / Lenguaje"></i>
    @forelse ($resource->technology() as $tag)
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

    <div class="row" style="margin-top:20px">
        <div class="col-sm-12">
            <!-- Adm -->
            @if (isLogged())

                @if ( $resource->canWrite(user()) )
                    <a href="{!! route('edit-resource', $resource->uuid()) !!}">
                        <i class="fa fa-edit fa-lg" aria-hidden="true" title="Editar recurso"></i>
                    </a>&nbsp;&nbsp;&nbsp;
                    <a href="{!! route('delete-resource', $resource->uuid()) !!}">
                        <i class="fa fa-trash fa-lg" aria-hidden="true" title="Eliminar recurso"></i>
                    </a>&nbsp;
                @endif

                @if ( $resource->canCheck())
                    <br>
                    <a href="{!! route('check-resource', $resource->uuid()) !!}">
                        <i class="fa fa-check-square-o fa-lg green" aria-hidden="true"></i>
                    </a>
                @endif

                @if ( isAdmin() )
                    <a href="{!! route('destroy-resource', $resource->uuid()) !!}" class="icon-resource-register">
                        <i class="fa fa-trash fa-lg red" aria-hidden="true" title="Eliminar recurso"></i>
                    </a>&nbsp;
                @endif

            @endif
        </div>
    </div>


</div>