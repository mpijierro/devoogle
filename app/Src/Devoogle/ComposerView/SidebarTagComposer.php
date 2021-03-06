<?php

namespace Devoogle\Src\Devoogle\ComposerView;

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

    private $commonTags;


    public function __construct(TagRepositoryRead $tagRepositoryRead)
    {

        $this->tagRepositoryRead = $tagRepositoryRead;
    }


    public function compose(View $view)
    {

        $this->initializeView($view);

        $this->obtainTags();

        $this->sendTagsToView();

        $this->configureTagSelected();

    }


    private function initializeView(View $view)
    {
        $this->view = $view;
    }


    private function obtainTags()
    {
        $this->commonTags = $this->tagRepositoryRead->allWithoutType()->sortBy('name');
    }


    private function sendTagsToView()
    {
        $this->view->with('tags', $this->commonTags);
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
        return Route::currentRouteName() == \Devoogle\Src\Devoogle\Library\Route::ROUTE_NAME_TAG_LIST;
    }


    private function sendSelectedCategorySlugToView()
    {

        $route = Route::current();

        $this->setTagSelected($route->parameter('slug'));

    }

}