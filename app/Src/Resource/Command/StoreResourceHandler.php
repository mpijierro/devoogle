<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Model\Resource;
use Mulidev\Src\Resource\Repository\ResourceRepository;
use Mulidev\Src\Version\Model\Version;


class StoreResourceHandler
{

    /**
     * @var ResourceRepository
     */
    private $resourceRepository;

    private $command;

    private $resource;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }


    public function __invoke(StoreResourceCommand $command)
    {

        $this->initializeCommand($command);

        $this->fill();

        $this->create();

        $this->attachTags();

    }

    private function initializeCommand(StoreResourceCommand $command)
    {
        $this->command = $command;
    }


    private function fill()
    {

        $this->resource = new Resource();
        $this->resource->user_id = $this->command->getUserId();
        $this->resource->uuid = $this->command->getUuid();
        $this->resource->title = $this->command->getTitle();
        $this->resource->description = $this->command->getDescription();
        $this->resource->url = $this->command->getUrl();
        $this->resource->slug = $this->obtainSlug($this->command);
        $this->resource->category_id = $this->command->getCategoryId();
        $this->resource->lang_id = $this->command->getLangId();
        $this->resource->comment = $this->command->getComment();

    }

    private function create()
    {
        $this->resourceRepository->save($this->resource);
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
        return str_slug($this->command->getTitle()) . '-' . strtolower(str_random(Resource::LONG_RANDOM_STRING_IN_SLUG));
    }

}