<div class="single category">
    <h3 class="side-title title-sidebar">Recursos</h3>
    <ul class="list-unstyled">
        @foreach ($tags as $tag)

            {{ $loop->first ? '' : ', ' }}
            <span class="nice">
                <a href="{{route('list-tag', $tag->slug)}}"
                   class="{!! $tag->slug == $tagSelectedSlug?'bold':'' !!}">{{ $tag->name }}</a>
            </span>

        @endforeach
    </ul>
</div>

