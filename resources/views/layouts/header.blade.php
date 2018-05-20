<script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/devoogle.js') }}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

@if (isset($loadTagManager))

    <link rel="stylesheet" href="/css/textext.core.css" type="text/css"/>
    <link rel="stylesheet" href="/css/textext.plugin.tags.css" type="text/css"/>
    <link rel="stylesheet" href="/css/textext.plugin.autocomplete.css" type="text/css"/>
    <link rel="stylesheet" href="/css/textext.plugin.prompt.css" type="text/css"/>
    <script src="/js/textext.core.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/textext.plugin.tags.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/textext.plugin.autocomplete.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/textext.plugin.suggestions.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/textext.plugin.prompt.js" type="text/javascript" charset="utf-8"></script>
    <script src="/js/textext.plugin.ajax.js" type="text/javascript" charset="utf-8"></script>
@endif


<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap-social.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">

