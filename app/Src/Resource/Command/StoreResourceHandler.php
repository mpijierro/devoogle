<?php

namespace Devoogle\Src\Resource\Command;

use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Resource\Repository\ResourceRepositoryWrite;


class StoreResourceHandler
{

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
        $this->resourceRepositoryWrite->save($this->resource);
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