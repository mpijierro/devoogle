<div class="single category">
    <h3 class="side-title">Formatos</h3>
    <ul class="list-unstyled">
        @foreach ($categories as $category)
            <li>
                <a href="{!! route('list-category', $category->slug) !!}"
                   title="Recursos de programación de {!! $category->name() !!}"
                   class="{!! $category->hasSlug($categorySelectedSlug)?'bold':'' !!}">
                    {!! $category->name() !!}
                </a>
            </li>
        @endforeach
    </ul>
</div>