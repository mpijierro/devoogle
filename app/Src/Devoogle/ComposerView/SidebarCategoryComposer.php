<?php

namespace Devoogle\Src\Devoogle\ComposerView;

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Devoogle\Src\Category\Repository\CategoryRepositoryRead;

class SidebarCategoryComposer
{

    /**
     * @var CategoryRepositoryRead
     */
    private $categoryRepositoryRead;

    public function __construct(CategoryRepositoryRead $categoryRepositoryRead)
    {
        $this->categoryRepositoryRead = $categoryRepositoryRead;
    }


    public function compose(View $view)
    {

        $this->sendCategoriesToView($view);

        $this->configureCategorySelected($view);

    }

    private function sendCategoriesToView(View $view)
    {
        $categories = $this->categoryRepositoryRead->allOrderByName();

        $view->with('categories', $categories);
    }


    private function configureCategorySelected(View $view)
    {

        $view->with('categorySelectedSlug', '');

        if ($this->isCategoryList()) {
            $this->sendSelectedCategorySlugToView($view);
        }

    }


    private function isCategoryList()
    {
        return Route::currentRouteName() == \Devoogle\Src\Devoogle\Library\Route::ROUTE_NAME_CATEGORY_LIST;
    }

    private function sendSelectedCategorySlugToView(View $view)
    {

        $route = Route::current();

        $view->with('categorySelectedSlug', $route->parameter('slug'));


    }


}