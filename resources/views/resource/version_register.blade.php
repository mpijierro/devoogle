<a href="{!! $version->url() !!}" target="_blank">Formato <b>{!! strtolower($version->category->name()) !!}</b></a>

@if (!empty($version->comment()))
    , {!! $version->comment() !!}
@endif

@if ( ! $version->isReviewed() or isAdmin() )
    <br><a href="{!! route('edit-version', $version->uuid()) !!}">Editar</a>&nbsp;
    <a href="{!! route('delete-version', $version->uuid()) !!}">Borrar</a>&nbsp;
@endif


@if( isAdmin() and (! $version->isReviewed()) )
    <a href="{!! route('check-version', $version->uuid()) !!}">Marcar como revisado</a>
@endif