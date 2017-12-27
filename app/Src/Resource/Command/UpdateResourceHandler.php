<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Model\Resource;
use Mulidev\Src\Resource\Repository\ResourceMap;
use Mulidev\Src\Resource\Repository\ResourceRepository;

class UpdateResourceHandler
{

    private $command;

    private $resource;

    private $map;

    private $resourceRepository;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }


    public function __invoke(UpdateResourceCommand $command)
    {

        $this->initializaCommand($command);

        $this->findResource($command->getUuid());

        $this->createResourceMap();

        $this->updateResource();

        $this->syncTags();

    }

    private function initializaCommand(UpdateResourceCommand $command)
    {
        $this->command = $command;
    }

    private function findResource(string $aUuid)
    {
        $this->resource = $this->resourceRepository->findByUuid($aUuid);
    }

    private function createResourceMap()
    {
        $this->map = new ResourceMap($this->command->getTitle(), $this->command->getDescription(), $this->command->getUrl(), '', $this->command->getCategoryId(), $this->command->getLangId());
    }

    private function updateResource()
    {
        $this->resourceRepository->update($this->map, $this->resource->id());
    }


    private function syncTags()
    {

        $inputTags = explode(',', $this->command->getTag());

        $sanitizeTags = [];

        foreach ($inputTags as $tag) {

            $sanitizeTag = trim($tag);

            if ( ! empty($sanitizeTag)) {
                $sanitizeTags[] = $sanitizeTag;
            }
        }

        $this->resource->syncTags($sanitizeTags);
    }

}