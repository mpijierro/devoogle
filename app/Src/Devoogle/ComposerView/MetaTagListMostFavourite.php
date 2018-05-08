<?php

namespace Devoogle\Src\Devoogle\ComposerView;

use Devoogle\Src\Tag\Repository\TagRepositoryRead;

class MetaTagListMostFavourite implements MetaInteface
{

    use Pageable;

    protected $title = '';

    protected $description = '';

    private $tag;

    /**
     * @var TagRepositoryRead
     */
    private $tagRepositoryRead;


    public function __construct(TagRepositoryRead $tagRepositoryRead)
    {

        $this->tagRepositoryRead = $tagRepositoryRead;

        $this->findTag();

        $this->configTitle();

        $this->configDescription();

        $this->addPage();

    }


    private function findTag()
    {

        $slug = request()->route('slug');

        $this->tag = $this->tagRepositoryRead->findBySlugOrFail($slug);
    }


    private function configTitle()
    {
        $this->title = 'Recursos de programación de ' . $this->tag->name;
    }


    private function configDescription()
    {
        $this->description = 'Recursos de programación y desarrollo de software, vídeos de programación y desarrollo de software ' . $this->tag->name;
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