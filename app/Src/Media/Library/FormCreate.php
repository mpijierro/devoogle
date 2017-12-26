<?php

namespace Mulidev\Src\Media\Library;

use Mulidev\Src\Category\Repository\CategoryRepository;
use Mulidev\Src\Lang\Repository\LangRepository;

class FormCreate
{

    private $categoryOptions;
    private $langOptions;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var LangRepository
     */
    private $langRepository;

    /**
     * @param CategoryRepository $categoryRepository
     * @param LangRepository $langRepository
     */
    public function __construct(CategoryRepository $categoryRepository, LangRepository $langRepository)
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