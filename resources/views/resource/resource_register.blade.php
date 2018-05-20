<div class="col-xs-12 list-register">
    <div class="row">
        <div class="col-sm-10">
            <a href="{!! $resource->url() !!}" target="_blank" class="resource-title">{!! $resource->title() !!}</a>
        </div>
        <div class="col-sm-2" align="right">

            @if (isLogged())
                <a href="{!! route('toggle-favourite', $resource->uuid()) !!}">
                    @if($resource->isFavourite(user()))
                        <i class="fa fa-heart fa-sm red" aria-hidden="true" title="Desmarcar como favorito"></i>
                    @else
                        <i class="fa fa-heart fa-sm gray" aria-hidden="true" title="Marcar como favorito"></i>
                    @endif
                </a>&nbsp;
                &nbsp;
                <a href="{!! route('toggle-later', $resource->uuid()) !!}">
                    @if ($resource->isLater(user()))
                        <i class="fa fa-clock-o fa-sm orange" aria-hidden="true" title="Desmarcar para ver después"></i>
                    @else
                        <i class="fa fa-clock-o fa-sm gray" aria-hidden="true" title="Marcar para ver después"></i>
                    @endif
                </a>&nbsp;&nbsp;
                &nbsp;
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
        <div class="col-sm-12">
            <div class="row">
                <!-- Category -->
                <div class="col-xs-6 col-md-2">
                    <i class="fa fa-folder-open-o" aria-hidden="true" title="Formato"></i>
                    <span class="nice"><a
                                href="{{route('list-category', $resource->category->slug()) }}">{!! $resource->category->name()  !!}</a></span>

                </div>
                <!-- Published at -->
                <div class="col-xs-6 col-md-2">
                    <i class="fa fa-calendar " aria-hidden="true"
                       title="Fecha de publicación"></i>
                    <span class="nice">{!! $resource->publishedAt()->format('d-m-Y') !!}</span>
                </div>

                <!-- Lang -->
                <div class="col-xs-6 col-md-2 ">
                    <i class="fa fa-language " aria-hidden="true" title="Idioma"></i>
                    <span class="nice">{!! $resource->lang->name() !!}</span>
                </div>

                <!-- Tags -->
                <div class="col-xs-6 col-md-6 col-lg-6">
                    <i class="fa fa-tags " aria-hidden="true" title="Etiquetas"></i>
                    @forelse ($resource->allTags() as $tag)
                        {{ $loop->first ? '' : ', ' }}
                        <span class="nice"><a href="{{route('list-tag', $tag->slug)}}">{{ $tag->name }}</a></span>
                    @empty
                        -
                    @endforelse
                </div>

                <!-- Version -->
                <div class="col-xs-6 col-md-4">
                    <i class="" aria-hidden="true" title="Otros formatos disponibles"></i>
                    @forelse ($resource->version as $version)
                        {{ $loop->first ? '' : ' ' }}

                        @include ('layouts.icons_category', ['slug' => $version->category->slug])
                        <span class="nice"><a href="{{ $version->url() }}" target="_blank"
                                              title="{!! $version->comment() !!}">En formato {{ $version->category->name() }}</a></span>
                        <i class=""></i>
                    @empty
                        Sin otros formatos.
                    @endforelse

                </div>

                <div class="col-xs-6 col-md-8">
                    <a href="{!! route('create-version', $resource->uuid()) !!}" title="Añadir nuevo formato" class="">
                        <i class="fa fa-plus-square" aria-hidden="true"></i> Añadir formato
                    </a>
                </div>
            </div>

        </div>

        <!-- Adm -->
        @if (isLogged())
            <div class="row" style="margin-top:20px">
                <div class="col-sm-12">


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
                        <br>
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
    </div>

    <div class="row list-description">
        <div class="col-xs-12 morelink">
            @if ($resource->hasDescription())
                {!! $resource->sanititizeDescription()  !!}
            @else
                Sin descripción.
            @endif
        </div>
    </div>

</div>