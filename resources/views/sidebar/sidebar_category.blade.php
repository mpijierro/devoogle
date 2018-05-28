<div class="single category hidden-xs ">
    <h3 class="side-title title-sidebar">Formatos</h3>
    <ul class="list-unstyled">
        @foreach ($categories as $category)
            <li class="category-sidebar">
                @include ('layouts.icons_category', ['slug' => $category->slug])
                <a href="{!! route('list-category', $category->slug) !!}"
                   title="Recursos de programación de {!! $category->name() !!}"
                   class="{!! $category->isSlug($categorySelectedSlug)?'bold':'' !!} icon-category-sidebar">
                    {!! $category->name() !!}s
                </a>
            </li>
        @endforeach
    </ul>
</div>