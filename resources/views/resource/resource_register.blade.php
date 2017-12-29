<div class="col-xs-12">
    <a href="{!! $resource->url() !!}" target="_blank" style="font-size: 18px">{!! $resource->title() !!}</a>
    @if ($resource->hasDescription())
        <br>
        {!! $resource->description()  !!}
    @endif
</div>

<div class="col-xs-12" style="margin-top:15px;">

    <i class="fa fa-folder-open" aria-hidden="true"></i>
    <span class="nice"><a
                href="{{route('list-category', $resource->category->slug()) }}">{!! $resource->category->name()  !!}</a></span>

    <i class="fa fa-language icon-resource-register" aria-hidden="true"></i> <span
            class="nice">{!! $resource->lang->name() !!}</span>


    <i class="fa fa-eye icon-resource-register" aria-hidden="true"></i>
    @foreach ($resource->version as $version)
        {{ $loop->first ? '' : ', ' }}
        <span class="nice"><a href="{{ $version->url() }}" target="_blank"
                              title="{!! $version->comment() !!}">{{ $version->category->name() }}</a></span>
    @endforeach

    <i class="fa fa-tags icon-resource-register" aria-hidden="true"></i>
    @foreach ($resource->tags as $tag)
        {{ $loop->first ? '' : ', ' }}
        <span class="nice"><a href="{{route('list-tag', $tag->slug)}}">{{ $tag->name }}</a></span>
    @endforeach

    @if (isLogged())

        @if ( ! $resource->isReviewed() or isAdmin() )
            <br><br>
            <a href="{!! route('edit-resource', $resource->uuid()) !!}">Editar</a>&nbsp;&nbsp;&nbsp;
            <a href="{!! route('delete-resource', $resource->uuid()) !!}">Borrar</a>&nbsp;
        @endif

        @if( isAdmin() )

            @if ( ! $resource->isReviewed())
                <a href="{!! route('check-resource', $resource->uuid()) !!}">Marcar como revisado</a>
            @endif
        @endif
    @endif

</div>