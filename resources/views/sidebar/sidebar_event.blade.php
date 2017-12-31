<div class="single category">
    <h3 class="side-title">Eventos</h3>
    <ul class="list-unstyled">
        @foreach ($events as $tag)

            {{ $loop->first ? '' : ', ' }}
            <span class="nice">
                <a href="{{route('list-tag', $tag->slug)}}"
                   class="{!! $tag->slug == $tagSelectedSlug?'bold':'' !!}"

                >{{ $tag->name }}</a>
            </span>

        @endforeach
    </ul>
</div>

