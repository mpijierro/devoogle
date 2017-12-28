<b>Enlace</b>: <a href="{!! $version->url() !!}" target="_blank">Visitar</a><br>
<b>Categoría</b>: <span class="nice"><a href="{{route('list-category', $version->category->slug()) }}">{!! $version->category->name()  !!}</a></span><br>
<b>Comentario</b>: {!! $version->comment() !!}
<br><br>
@if ( ! $version->isReviewed() or isAdmin() )
    <a href="{!! route('edit-resource', $version->uuid()) !!}">Editar</a>&nbsp;
@endif


@if( isAdmin() )
    <a href="{!! route('delete-resource', $version->uuid()) !!}">Borrar</a>&nbsp;
    @if ( ! $version->isReviewed())
        <a href="{!! route('check-resource', $version->uuid()) !!}">Marcar como revisado</a>
    @endif
@endif


<br>
<hr>
<br>