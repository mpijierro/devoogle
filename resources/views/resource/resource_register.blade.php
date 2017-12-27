<b>Enlace</b>: <a href="{!! $resource->url() !!}" target="_blank">{!! $resource->title() !!}</a><br>
<b>Descripción</b>: {!! $resource->description()  !!}<br>
<b>Categoría</b>: {!! $resource->categoryName()  !!}<br>
<b>Idioma</b>: {!! $resource->langName()  !!}<br>
<b>Etiquetas</b>:

@foreach ($resource->tags() as $tag)
    {{ $loop->first ? '' : ', ' }}
    <span class="nice"><a href="{{route('home-tag', $tag->slug)}}">{{ $tag->name }}</a></span>
@endforeach
<br>
@if ( ! $resource->isReviewed())
    <a href="{!! route('edit-resource', $resource->uuid()) !!}">Editar</a><br>
@endif


@if( isAdmin() )
    <a href="{!! route('delete-resource', $resource->uuid()) !!}">Borrar</a><br>
    @if ( ! $resource->isReviewed())
        <a href="{!! route('check-resource', $resource->uuid()) !!}">Marcar como revisado</a><br>
    @endif
@endif


<br>
<hr>
<br>