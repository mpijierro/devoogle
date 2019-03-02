<div class="row">
    <div class="col-xs-9 col-sm-8 col-md-12">
        <a href="{!! $resource->url() !!}" target="_blank" class="resource-title">{!! $resource->title() !!}</a>
    </div>
    <div class="col-xs-3 col-sm-4 col-md-12 text-right">

        @if (isLogged())

            <a href="{!! route('toggle-favourite', $resource->uuid()) !!}" class="icon-action-user">
                @if($resource->isFavourite(user()))
                    <i class="fa fa-heart fa-sm red" aria-hidden="true" title="Desmarcar como favorito"></i>
                @else
                    <i class="fa fa-heart fa-sm gray" aria-hidden="true" title="Marcar como favorito"></i>
                @endif
            </a>

            <a href="{!! route('toggle-later', $resource->uuid()) !!}" class="icon-action-user">
                @if ($resource->isLater(user()))
                    <i class="fa fa-clock-o fa-sm orange" aria-hidden="true" title="Desmarcar para ver después"></i>
                @else
                    <i class="fa fa-clock-o fa-sm gray" aria-hidden="true" title="Marcar para ver después"></i>
                @endif
            </a>

            <a href="{!! route('toggle-viewed', $resource->uuid()) !!}">
                @if ($resource->isViewed(user()))
                    <i class="fa fa-eye fa-sm green" aria-hidden="true" title="Desmarcar como visto"></i>
                @else
                    <i class="fa fa-eye-slash fa-sm gray" aria-hidden="true" title="Marcar como visto"></i>
                @endif
            </a>
        @endif

        @if (isset($showCountFavourite))
            <a href="#" rel="nofollow">
                <i class="fa fa-star yellow icon-resource-register" aria-hidden="true"></i>
                <b>{{$resource->favouriteCount()}}</b>
            </a>
        @endif
    </div>
</div>

<div class="row list-labeled">
    <div class="col-xs-12">
        <div class="row">

            <!-- Source -->
            <div class="col-xs-6 col-sm-4">
                <i class="fa fa-star icon-register" aria-hidden="true"
                   title="Fuente"></i>
                <span class="nice">
                    <a href="{!! $resource->sourceUrl() !!}" target="_blank" title="Fuente: {!! $resource->sourceName() !!}">
                        {!! $resource->sourceName() !!}
                    </a>
                </span>
            </div>

            <!-- Category -->
            <div class="col-xs-6 col-sm-3">
                <i class="fa fa-folder-open icon-register" aria-hidden="true"
                   title="Formato {{$resource->category->name()}}"></i>
                <span class="nice"><a
                            href="{{route('list-category', $resource->category->slug()) }}">{!! $resource->category->name()  !!}</a></span>

            </div>

            <!-- Published at -->
            <div class="col-xs-6 col-sm-3">
                <i class="fa fa-calendar icon-register" aria-hidden="true"
                   title="Fecha de publicación"></i>
                <span class="nice">{!! $resource->publishedAt()->format('d-m-Y') !!}</span>
            </div>

            <!-- Version -->
            @if ($resource->version->count())
                <div class="col-xs-6 col-sm-4">
                    <i class="" aria-hidden="true" title="Otros formatos disponibles"></i>

                    @foreach ($resource->version as $version)
                        {{ $loop->first ? '' : ' ' }}

                        @include ('layouts.icons_category', ['slug' => $version->category->slug])
                        <span class="nice"><a href="{{ $version->url() }}" target="_blank"
                                              title="{!! $version->comment() !!}">En {{ $version->category->name() }}</a></span>
                        <i class=""></i>

                    @endforeach

                </div>
            @endif

            @if ($resource->isFromYoutubeChannel())
                <!-- Download -->
                <div class="col-xs-12 col-sm-3 ">
                    <i class="fa fa-download icon-register" aria-hidden="true" title="Descargar"></i>
                    @if ($audioFile->exists($resource))

                        <a href="{!! route('download-audio', $resource->slug) !!}"
                           title="Descargar {!! $resource->title() !!} en formato audio">Descargar audio</a>

                    @else
                        <a href="#"
                           class="open-modal-download-audio"
                           title="Descargar {!! $resource->title() !!} en formato audio"
                           data-toggle="modal"
                           data-title="{!! $resource->title() !!}"
                           data-url="{!! route('download-audio', $resource->slug) !!}"
                           data-channel-name="{!! $resource->channel->first()->name() !!}"
                           data-channel-url="{!! $resource->channel->first()->url() !!}"
                           data-target="#modalDownloadAudio"
                        >Descargar audio</a>

                    @endif
                </div>
        @endif

        <!-- Tags -->
            <div class="col-xs-12 col-sm-4 ">
                <i class="fa fa-tags icon-register" aria-hidden="true" title="Etiquetas"></i>
                @forelse ($resource->allTags() as $tag)
                    {{ $loop->first ? '' : ', ' }}
                    <span class="nice"><a href="{{route('list-tag', $tag->slug)}}">{{ $tag->name }}</a></span>
                @empty
                    -
                @endforelse
            </div>
        </div>

    </div>
</div>

<div class="row list-description">
    <div class="col-xs-12 more">
        @if ($resource->hasDescription())
            {!! $resource->sanititizeDescription()  !!}
        @else
            Sin descripción.
        @endif
    </div>
</div>

<!-- Adm -->
@if (isLogged())
    <div class="row register-actions">


        <div class="col-xs-6">
            <a href="{!! route('create-version', $resource->uuid()) !!}" title="Añadir nuevo formato"
               class="">
                <i class="fa fa-plus-square" aria-hidden="true"></i> Añadir formato
            </a>
        </div>

        <div class="col-xs-6 text-right">

            @if ( $resource->canWrite(user()) )
                <a href="{!! route('edit-resource', $resource->uuid()) !!}">
                    <i class="fa fa-edit fa-lg" aria-hidden="true" title="Editar recurso"></i>
                </a>&nbsp;&nbsp;&nbsp;
                <a href="{!! route('delete-resource', $resource->uuid()) !!}"
                   onclick="return confirm('¿Estás seguro/a de ELIMINAR este recurso?')">
                    <i class="fa fa-trash fa-lg" aria-hidden="true" title="Eliminar recurso"></i>
                </a>&nbsp;
            @endif

            @if ( $resource->canCheck())
                <a href="{!! route('check-resource', $resource->uuid()) !!}">
                    <i class="fa fa-check-square-o fa-lg green" aria-hidden="true"></i>
                </a>
            @endif

            @if ( isAdmin() )
                <a href="{!! route('destroy-resource', $resource->uuid()) !!}"
                   class="icon-resource-register"
                   onclick="return confirm('¿Estás seguro/a de ELIMINAR para siempre este recurso?')">
                    <i class="fa fa-trash fa-lg red" aria-hidden="true" title="Eliminar recurso"></i>
                </a>&nbsp;
            @endif
        </div>


    </div>

@endif

