<a href="{!! $resource->url() !!}" target="_blank" style="font-size: 18px">{!! $resource->title() !!}</a>
<br><br>
<i class="fa fa-folder-open" aria-hidden="true"></i>
<span class="nice"><a href="{{route('list-category', $resource->categorySlug()) }}">{!! $resource->categoryName()  !!}</a></span>
&nbsp;&nbsp;&nbsp;<i class="fa fa-language" aria-hidden="true"></i> <span class="nice">{!! $resource->langName() !!}</span>
&nbsp;&nbsp;&nbsp;<i class="fa fa-tags" aria-hidden="true"></i>
@foreach ($resource->tags() as $tag)
    {{ $loop->first ? '' : ', ' }}
    <span class="nice"><a href="{{route('list-tag', $tag->slug)}}">{{ $tag->name }}</a></span>
@endforeach
<br>

<i class="fa fa-comment" aria-hidden="true"></i> {!! $resource->description()  !!}

<br><br>
<i class="fa fa-eye" aria-hidden="true"></i> ...añadir aquí las versiones<br>


@if ($resource->hasComment())
    <br><br>
    <i class="fa fa-comment" aria-hidden="true"></i> {!! $resource->comment()  !!}
@endif

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