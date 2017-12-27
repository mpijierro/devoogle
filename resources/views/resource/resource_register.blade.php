<b>Enlace</b>: <a href="{!! $resource->url() !!}" target="_blank">{!! $resource->title() !!}</a><br>
<b>Descripción</b>: {!! $resource->description()  !!}<br>
<b>Categoría</b>: <span class="nice"><a href="{{route('list-category', $resource->categorySlug()) }}">{!! $resource->categoryName()  !!}</a></span><br>
<b>Idioma</b>: {!! $resource->langName()  !!}<br>
<b>Etiquetas</b>:

@foreach ($resource->tags() as $tag)
    {{ $loop->first ? '' : ', ' }}
    <span class="nice"><a href="{{route('list-tag', $tag->slug)}}">{{ $tag->name }}</a></span>
@endforeach
<br><br>
@if ( ! $resource->isReviewed() or isAdmin() )
    <a href="{!! route('edit-resource', $resource->uuid()) !!}">Editar</a>&nbsp;
@endif


@if( isAdmin() )
    <a href="{!! route('delete-resource', $resource->uuid()) !!}">Borrar</a>&nbsp;
    @if ( ! $resource->isReviewed())
        <a href="{!! route('check-resource', $resource->uuid()) !!}">Marcar como revisado</a>
    @endif
@endif


<br>
<hr>
<br>