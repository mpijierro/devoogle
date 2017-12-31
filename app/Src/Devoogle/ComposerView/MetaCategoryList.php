<?php


namespace Devoogle\Src\Devoogle\ComposerView;


use Devoogle\Src\Category\Repository\CategoryRepositoryRead;

class MetaCategoryList implements MetaInteface
{

    use Pageable;

    protected $title = '';
    protected $description = '';
    private $category;
    /**
     * @var CategoryRepositoryRead
     */
    private $categoryRepositoryRead;

    public function __construct(CategoryRepositoryRead $categoryRepositoryRead)
    {

        $this->categoryRepositoryRead = $categoryRepositoryRead;

        $this->findCategory();

        $this->configTitle();

        $this->configDescription();

        $this->addPage();

    }

    private function findCategory()
    {

        $slug = request()->route('slug');

        $this->category = $this->categoryRepositoryRead->findBySlugOrFail($slug);
    }


    private function configTitle()
    {
        $this->title = $this->category->name() . ' de programación';
    }

    private function configDescription()
    {
        $this->description = $this->category->name() . ' de programación y desarrollo de software, vídeos de programación y desarrollo de software en formato ' . $this->category->name();
    }

    public function title()
    {
        return $this->title;
    }

    public function description()
    {
        return $this->description;
    }
}