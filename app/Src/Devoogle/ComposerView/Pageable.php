<?php

namespace Devoogle\Src\Devoogle\ComposerView;

trait Pageable
{

    protected function addPage()
    {

        if (request()->has('page')) {

            $page = request()->get('page');

            $this->title .= ' - ' . $page;

            $this->description .= ' - ' . $page;

        }

    }

}