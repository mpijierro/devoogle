<?php

namespace Mulidev\Src\Resource\Library;

use Mulidev\Src\Category\Repository\CategoryRepository;
use Mulidev\Src\Lang\Repository\LangRepository;
use Mulidev\Src\Resource\Repository\ResourceRepository;
use Webpatser\Uuid\Uuid;

class FormEdit
{
    private $model;
    private $resource;
    private $categoryOptions;
    private $langOptions;

    private $categoryIdSelected;
    private $langIdSelected;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var LangRepository
     */
    private $langRepository;
    /**
     * @var ResourceRepository
     */
    private $resourceRepository;

    /**
     * @param CategoryRepository $categoryRepository
     * @param LangRepository $langRepository
     */
    public function __construct(ResourceRepository $resourceRepository, CategoryRepository $categoryRepository, LangRepository $langRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->langRepository = $langRepository;
        $this->model = [];
        $this->categoryOptions = [];
        $this->categoryIdSelected = 0;
        $this->langIdSelected = 0;
    }

    public function model()
    {
        return $this->model;
    }

    public function categoryOptions()
    {
        return $this->categoryOptions;
    }

    public function langOptions()
    {
        return $this->langOptions;
    }

    public function giveCategoryIdSelected()
    {
        return $this->categoryIdSelected;
    }

    public function giveLangIdSelected()
    {
        return $this->langIdSelected;
    }

    public function __invoke(string $uuid)
    {

        $this->obtainResource($uuid);

        $this->configModel();

        $this->configOptionsSelected();

        $this->configDropdownOptions();

    }

    private function obtainResource(string $uuid)
    {
        $this->resource = $this->resourceRepository->findByUuid($uuid);
    }


    private function configModel()
    {

        $this->model = $this->resource->toArray();
    }

    private function configOptionsSelected()
    {
        $this->categoryIdSelected = $this->resource->categoryId();
        $this->langIdSelected = $this->resource->langId();
    }

    private function configDropdownOptions()
    {

        $this->configCategoryOptions();

        $this->configLangOptions();

    }

    private function configCategoryOptions()
    {
        $this->categoryOptions = $this->categoryRepository->allOrderByName()->pluck('name', 'id');
    }


    private function configLangOptions()
    {
        $this->langOptions = $this->langRepository->allOrderByName()->pluck('name', 'id');
    }

}
