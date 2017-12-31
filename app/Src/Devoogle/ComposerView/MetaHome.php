<?php


namespace Devoogle\Src\Devoogle\ComposerView;


class MetaHome implements MetaInteface
{
    use Pageable;

    protected $title = '';

    protected $description = '';

    public function __construct()
    {

        $this->configTitle();

        $this->configDescription();

        $this->addPage();

    }

    private function configTitle()
    {
        $this->title = 'Devoogle - Recursos de programación';
    }

    private function configDescription()
    {
        $this->description = 'Devoogle - Recursos de programación y desarrollo de software, vídeos de programación y desarrollo de software';
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