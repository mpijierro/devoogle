@if ($slug == 'audio')
    <i class="fa fa-headphones" aria-hidden="true"></i>
@elseif ($slug == 'diapositivas')

    <i class="fa fa-slideshare" aria-hidden="true"></i>

@elseif ($slug == 'documento-texto')
    <i class="fa fa-file-text-o" aria-hidden="true"></i>

@elseif ($slug == 'video')
    <i aria-hidden="true" class="fa fa-caret-square-o-right"></i>

@elseif ($slug == 'web')
    <i class="fa fa-globe" aria-hidden="true"></i>
@endif