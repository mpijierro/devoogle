@if ($slug == 'audio')
    <i class="fa fa-headphones icon-register" aria-hidden="true"></i>
@elseif ($slug == 'diapositivas')

    <i class="fa fa-slideshare icon-register" aria-hidden="true"></i>

@elseif ($slug == 'documento-texto')
    <i class="fa fa-file-text-o icon-register" aria-hidden="true"></i>

@elseif ($slug == 'video')
    <i aria-hidden="true" class="fa fa-caret-square-o-right icon-register"></i>

@elseif ($slug == 'web')
    <i class="fa fa-globe icon-register" aria-hidden="true"></i>
@endif