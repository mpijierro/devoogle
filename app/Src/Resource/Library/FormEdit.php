<?php

namespace Devoogle\Src\Resource\Library;

use Devoogle\Src\Category\Repository\CategoryRepositoryRead;
use Devoogle\Src\Lang\Repository\LangRepositoryRead;
use Devoogle\Src\Devoogle\Library\Form;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Tag\Model\Tag;
use Webpatser\Uuid\Uuid;

class FormEdit extends Form
{

    private $resource;
    private $categoryOptions;
    private $langOptions;

    private $categoryIdSelected;
    private $langIdSelected;

    /**
     * @var CategoryRepositoryRead
     */
    private $categoryRepository;
    /**
     * @var LangRepositoryRead
     */
    private $langRepository;
    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepository;

    /**
     * @param CategoryRepositoryRead $categoryRepository
     * @param LangRepositoryRead $langRepository
     */
    public function __construct(ResourceRepositoryRead $resourceRepository, CategoryRepositoryRead $categoryRepository, LangRepositoryRead $langRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->langRepository = $langRepository;
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

        $this->configAction();

        $this->configOptionsSelected();

        $this->configDropdownOptions();

    }

    private function obtainResource(string $uuid)
    {
        $this->resource = $this->resourceRepository->findByUuid($uuid);
    }


    protected function configModel()
    {
        $this->model = $this->resource->toArray();

        $this->configTagModel();

        $this->configAuthorTagModel();

    }

    private function configTagModel()
    {
        $this->model['tag'] = $this->resource->tagsWithType(null)->implode('name', ', ');
    }

    private function configAuthorTagModel()
    {
        $this->model['author'] = $this->resource->tagsWithType(Tag::TYPE_AUTHOR)->implode('name', ', ');
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

    protected function configAction()
    {
        $this->action = route('update-resource', $this->resource->uuid());
    }

}
