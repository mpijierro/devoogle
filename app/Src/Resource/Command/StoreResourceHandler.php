<?php

namespace Devoogle\Src\Resource\Command;

use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Resource\Model\Taggable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryWrite;


class StoreResourceHandler
{

    use Taggable;

    private $command;

    private $resource;
    /**
     * @var ResourceRepositoryWrite
     */
    private $resourceRepositoryWrite;


    public function __construct(ResourceRepositoryWrite $resourceRepositoryWrite)
    {
        $this->resourceRepositoryWrite = $resourceRepositoryWrite;
    }


    public function __invoke(StoreResourceCommand $command)
    {

        $this->initializeCommand($command);

        $this->fill();

        $this->create();

        $this->attachAuthorTags();

        $this->attachResourceTags();

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
        $this->resource->description = trim($this->command->getDescription());
        $this->resource->url = trim($this->command->getUrl());
        $this->resource->slug = $this->obtainSlug($this->command);
        $this->resource->category_id = $this->command->getCategoryId();
        $this->resource->lang_id = $this->command->getLangId();

    }

    private function create()
    {
        $this->resourceRepositoryWrite->save($this->resource);
    }

    private function attachResourceTags()
    {
        $this->attachTags($this->resource, $this->command->getTag());
    }

    private function attachAuthorTags()
    {
        $this->attachTagsWithAuthor($this->resource, $this->command->getAuthor());
    }

    private function obtainSlug()
    {
        return str_slug($this->command->getTitle()) . '-' . strtolower(str_random(Resource::LONG_RANDOM_STRING_IN_SLUG));
    }

}