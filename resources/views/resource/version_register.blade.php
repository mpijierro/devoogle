<a href="{!! $version->url() !!}" target="_blank">Formato <b>{!! strtolower($version->category->name()) !!}</b></a>

@if (!empty($version->comment()))
    , {!! $version->comment() !!}
@endif

@if ( ! $version->isReviewed() or isAdmin() )
    <br><a href="{!! route('edit-version', $version->uuid()) !!}"> <i class="fa fa-edit fa-lg" aria-hidden="true" title="Editar recurso"></i></a>&nbsp;
    <a href="{!! route('delete-version', $version->uuid()) !!}" onclick="return confirm('¿Estás seguro/a de ELIMINAR esta versión?')">
        <i class="fa fa-trash fa-lg" aria-hidden="true" title="Eliminar versión"></i>
    </a>&nbsp;
@endif


@if( isAdmin() and (! $version->isReviewed()) )
    <a href="{!! route('check-version', $version->uuid()) !!}">Marcar como revisado</a>
@endif