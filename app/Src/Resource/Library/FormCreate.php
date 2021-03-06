<?php

namespace Devoogle\Src\Resource\Library;

use Devoogle\Src\Category\Repository\CategoryRepositoryRead;
use Devoogle\Src\Devoogle\Library\Form;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Lang\Repository\LangRepositoryRead;

class FormCreate extends Form
{

    use FormTaggable;

    private $categoryOptions;

    private $langOptions;

    /**
     * @var CategoryRepositoryRead
     */
    private $categoryRepository;

    /**
     * @var LangRepositoryRead
     */
    private $langRepository;


    /**
     * @param CategoryRepositoryRead $categoryRepository
     * @param LangRepositoryRead $langRepository
     */
    public function __construct(CategoryRepositoryRead $categoryRepository, LangRepositoryRead $langRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryOptions = [];
        $this->langRepository = $langRepository;
    }


    public function categoryOptions()
    {
        return $this->categoryOptions;
    }


    public function langOptions()
    {
        return $this->langOptions;
    }


    public function __invoke()
    {

        $this->configModel();

        $this->configAction();

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


    protected function configModel()
    {
        $this->model = [];
        $this->model['lang_id'] = Lang::LANG_UNSPECIFIED;
    }


    protected function configAction()
    {
        $this->action = route('store-resource');
    }

}