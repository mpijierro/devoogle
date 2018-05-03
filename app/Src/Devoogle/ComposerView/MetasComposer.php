<?php

namespace Devoogle\Src\Devoogle\ComposerView;

use Illuminate\View\View;

class MetasComposer
{

    /**
     * @var MetaFactory
     */
    private $metaFactory;


    public function __construct(MetaFactory $metaFactory)
    {
        $this->metaFactory = $metaFactory;
    }


    public function compose(View $view)
    {

        $metaPage = $this->metaFactory->build();

        $view->with('pageTitle', $metaPage->title());

        $view->with('pageDescription', $metaPage->description());

    }
}