<?php


namespace Devoogle\Src\Devoogle\ComposerView;


use Devoogle\Src\Category\Repository\CategoryRepositoryRead;
use Devoogle\Src\Tag\Repository\TagRepositoryRead;

class MetaMostFavouriteList implements MetaInteface
{

    use Pageable;

    protected $title = '';
    protected $description = '';
    /**
     * @var TagRepositoryRead
     */
    private $tagRepositoryRead;

    public function __construct(TagRepositoryRead $tagRepositoryRead)
    {

        $this->tagRepositoryRead = $tagRepositoryRead;

        $this->configTitle();

        $this->configDescription();

        $this->addPage();

    }

    private function configTitle()
    {
        $this->title = 'Los recursos de programación gratis más valorados ';
    }

    private function configDescription()
    {
        $this->description = 'Los recursos de programación y desarrollo de software, vídeos de programación y desarrollo de software gratis más valorados';
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