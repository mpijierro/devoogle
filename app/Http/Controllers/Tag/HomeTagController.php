<?php

namespace Mulidev\Http\Controllers\Tag;

class HomeTagController
{

    public function __invoke()
    {

        dd('...listado por tags');

        //view()->share('view', $view);

        return view('resource.home');
    }
}
