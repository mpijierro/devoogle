<?php

namespace Mulidev\Src\Media\Command;


use Mulidev\Src\Category\Repository\MediaRepository;

class StoreMediaHandler
{

    /**
     * @var MediaRepository
     */
    private $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {

        $this->mediaRepository = $mediaRepository;
    }


    public function __invoke(StoreMediaCommand $command)
    {


    }

}