<?php

namespace Mulidev\Src\Version\Library;

use Mulidev\Src\Category\Repository\CategoryRepositoryRead;
use Mulidev\Src\Lang\Repository\LangRepositoryRead;
use Mulidev\Src\Mulidev\Library\Form;
use Mulidev\Src\Version\Repository\VersionRepositoryRead;

class FormEdit extends Form
{

    private $uuid;

    private $version;

    private $categoryOptions;

    private $categoryRepository;
    /**
     * @var VersionRepositoryRead
     */
    private $repositoryRead;


    /**
     * @param CategoryRepositoryRead $categoryRepository
     * @param LangRepositoryRead $langRepositor
     */
    public function __construct(CategoryRepositoryRead $categoryRepository, VersionRepositoryRead $repositoryRead)
    {
        $this->categoryRepository = $categoryRepository;
        $this->repositoryRead = $repositoryRead;
        $this->categoryOptions = [];
    }

    public function categoryOptions()
    {
        return $this->categoryOptions;
    }


    public function __invoke($uuid)
    {

        $this->initializeUuid($uuid);

        $this->findVersion();

        $this->configModel();

        $this->configAction();

        $this->configCategoryOptions();

    }

    private function initializeUuid(string $uuid)
    {
        $this->uuid = $uuid;
    }

    private function findVersion()
    {
        $this->version = $this->repositoryRead->findByUuid($this->uuid);
    }

    protected function configModel()
    {
        $this->model = [];

        $this->model['url'] = $this->version->url();
        $this->model['category_id'] = $this->version->categoryId();
        $this->model['comment'] = $this->version->comment();

    }

    protected function configAction()
    {
        $this->action = route('update-version', $this->uuid);
    }

    private function configCategoryOptions()
    {
        $this->categoryOptions = $this->categoryRepository->allOrderByName()->pluck('name', 'id');
    }

}