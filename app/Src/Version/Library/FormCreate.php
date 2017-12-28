<?php

namespace Mulidev\Src\Version\Library;

use Mulidev\Src\Category\Repository\CategoryRepositoryRead;
use Mulidev\Src\Lang\Repository\LangRepositoryRead;
use Mulidev\Src\Mulidev\Library\Form;

class FormCreate extends Form
{

    private $parentUuid;

    private $categoryOptions;

    private $categoryRepository;


    /**
     * @param CategoryRepositoryRead $categoryRepository
     * @param LangRepositoryRead $langRepositor
     */
    public function __construct(CategoryRepositoryRead $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryOptions = [];
    }

    public function categoryOptions()
    {
        return $this->categoryOptions;
    }


    public function __invoke($parentUuid)
    {

        $this->initializeParentUuid($parentUuid);

        $this->configModel();

        $this->configAction();

        $this->configCategoryOptions();


    }

    private function initializeParentUuid(string $parentUuid)
    {
        $this->parentUuid = $parentUuid;
    }

    protected function configModel()
    {
        $this->model = [];
    }

    protected function configAction()
    {
        $this->action = route('create-version', $this->parentUuid);
    }

    private function configCategoryOptions()
    {
        $this->categoryOptions = $this->categoryRepository->allOrderByName()->pluck('name', 'id');
    }

}