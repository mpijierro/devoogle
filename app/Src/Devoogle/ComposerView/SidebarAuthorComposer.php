<?php

namespace Devoogle\Src\Devoogle\ComposerView;

use Devoogle\Src\Tag\Model\Tag;
use Devoogle\Src\Tag\Repository\TagRepositoryRead;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class SidebarAuthorComposer
{
    /**
     * @var TagRepositoryRead
     */
    private $tagRepositoryRead;

    private $view;

    private $authorsTags;

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
        $this->authorsTags = $this->tagRepositoryRead->allWithType(Tag::TYPE_AUTHOR)->sortBy('name');
    }

    private function sendTagsToView()
    {

        $this->view->with('authors', $this->authorsTags);
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