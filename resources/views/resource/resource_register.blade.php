<div class="col-xs-12">
    <a href="{!! $resource->url() !!}" target="_blank" style="font-size: 18px">{!! $resource->title() !!}</a>
    @if ($resource->hasDescription())
        <br>
        {!! $resource->description()  !!}
    @endif
</div>

<div class="col-xs-12" style="margin-top:15px;">

    <!-- Lang -->
    <i class="fa fa-language" aria-hidden="true"></i> <span
            class="nice">{!! $resource->lang->name() !!}</span>


    <!-- Version -->
    <i class="fa fa-caret-square-o-right icon-resource-register" aria-hidden="true"></i>
    @forelse ($resource->version as $version)
        {{ $loop->first ? '' : ', ' }}
        <span class="nice"><a href="{{ $version->url() }}" target="_blank"
                              title="{!! $version->comment() !!}">{{ $version->category->name() }}</a></span>
    @empty
        No vers.
    @endforelse


<!-- Category -->
    <i class="fa fa-folder-open-o icon-resource-register" aria-hidden="true"></i>
    <span class="nice"><a
                href="{{route('list-category', $resource->category->slug()) }}">{!! $resource->category->name()  !!}</a></span>

    <!-- Tag -->
    <i class="fa fa-tags icon-resource-register" aria-hidden="true"></i>
    @foreach ($resource->tags as $tag)
        {{ $loop->first ? '' : ', ' }}
        <span class="nice"><a href="{{route('list-tag', $tag->slug)}}">{{ $tag->name }}</a></span>
    @endforeach


<!-- Adm -->
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