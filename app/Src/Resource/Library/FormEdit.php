<?php

namespace Devoogle\Src\Resource\Library;

use Devoogle\Src\Category\Repository\CategoryRepositoryRead;
use Devoogle\Src\Devoogle\Library\Form;
use Devoogle\Src\Lang\Repository\LangRepositoryRead;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Tag\Model\Tag;

class FormEdit extends Form
{

    use FormTaggable;

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


    public function __invoke(string $uuid)
    {

        $this->obtainResource($uuid);

        $this->configModel();

        $this->configAction();

        $this->configOptionsSelected();

        $this->configDropdownOptions();

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


    private function obtainResource(string $uuid)
    {
        $this->resource = $this->resourceRepository->findByUuid($uuid);
    }


    protected function configModel()
    {
        $this->model = $this->resource->toArray();

        $this->configPublishedAt();

        $this->configCommonTagModel();

        $this->configAuthorTagModel();

        $this->configEventTagModel();

        $this->configTechnologyTagModel();

    }


    private function configPublishedAt()
    {
        $this->model['published_at'] = $this->resource->publishedAt()->format('d-m-Y');
    }


    private function configCommonTagModel()
    {
        $this->model[Tag::TYPE_COMMON] = $this->resource->tagsWithType(null)->implode('name', ', ');
    }


    private function configAuthorTagModel()
    {
        $this->model[Tag::TYPE_AUTHOR] = $this->resource->tagsWithType(Tag::TYPE_AUTHOR)->implode('name', ', ');
    }


    private function configEventTagModel()
    {
        $this->model[Tag::TYPE_EVENT] = $this->resource->tagsWithType(Tag::TYPE_EVENT)->implode('name', ', ');
    }


    private function configTechnologyTagModel()
    {
        $this->model[Tag::TYPE_TECHNOLOGY] = $this->resource->tagsWithType(Tag::TYPE_TECHNOLOGY)->implode('name', ', ');
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
