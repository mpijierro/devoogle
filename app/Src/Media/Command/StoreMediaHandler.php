<?php

namespace Mulidev\Src\Media\Command;

use Mulidev\Src\Media\Repository\CreateMediaDto;
use Mulidev\Src\Media\Repository\MediaRepository;

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

        $dto = $this->createDto($command);

        $this->mediaRepository->create($dto);

    }


    private function createDto(StoreMediaCommand $command)
    {
        return new CreateMediaDto($command->getTitle(), $command->getUrl(), $command->getCategoryId(), $command->getLangId());
    }

}