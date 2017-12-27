<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Model\Resource;
use Mulidev\Src\Resource\Repository\ResourceMap;
use Mulidev\Src\Resource\Repository\ResourceRepository;

class StoreResourceHandler
{

    /**
     * @var ResourceRepository
     */
    private $resourceRepository;

    private $command;

    private $resourceMap;

    private $resource;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }


    public function __invoke(StoreResourceCommand $command)
    {

        $this->initializeCommand($command);

        $this->createResourceMap();

        $this->createResource();

        $this->attachTags();

    }

    private function initializeCommand(StoreResourceCommand $command)
    {
        $this->command = $command;
    }


    private function createResourceMap()
    {
        $this->resourceMap = new ResourceMap($this->command->getTitle(), $this->command->getDescription(), $this->command->getUrl(), $this->obtainSlug($this->command), $this->command->getCategoryId(),
            $this->command->getLangId());
    }

    private function createResource()
    {
        $this->resource = $this->resourceRepository->create($this->resourceMap);
    }

    private function attachTags()
    {

        $tags = explode(',', $this->command->getTag());

        foreach ($tags as $tag) {

            $sanitizeTag = trim($tag);

            if ( ! empty($sanitizeTag)) {
                $this->resource->attachTag($sanitizeTag);
            }
        }
    }

    private function obtainSlug()
    {
        return str_slug($this->command->getTitle()) . '-' . str_random(Resource::LONG_RANDOM_STRING_IN_SLUG);
    }

}