<?php

namespace Devoogle\Src\Devoogle\Composer;

use Devoogle\Src\Tag\Library\RouteTag;
use Devoogle\Src\Tag\Repository\TagRepositoryRead;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class SidebarTagComposer
{
    /**
     * @var TagRepositoryRead
     */
    private $tagRepositoryRead;

    private $view;

    public function __construct(TagRepositoryRead $tagRepositoryRead)
    {

        $this->tagRepositoryRead = $tagRepositoryRead;
    }


    public function compose(View $view)
    {

        $this->initializeView($view);

        $this->sendTagsToView();

        $this->configureTagSelected();

    }

    private function initializeView(View $view)
    {
        $this->view = $view;
    }


    private function sendTagsToView()
    {
        $tags = $this->tagRepositoryRead->all();

        $this->view->with('tags', $tags);
    }


    private function configureTagSelected()
    {

        $this->setTagSelected('');

        if ($this->isTagList()) {
            $this->sendSelectedCategorySlugToView();
        }

    }

    private function setTagSelected($value)
    {

        $this->view->with('tagSelectedSlug', $value);
    }

    private function isTagList()
    {
        return Route::currentRouteName() == RouteTag::TAG_LIST_NAME;
    }

    private function sendSelectedCategorySlugToView()
    {

        $route = Route::current();

        $this->setTagSelected($route->parameter('slug'));

    }


}