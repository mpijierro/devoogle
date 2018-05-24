<?php

namespace Devoogle\Src\Resource\Command;

use Devoogle\Src\Resource\Model\Taggable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Resource\Repository\ResourceRepositoryWrite;

class UpdateResourceHandler
{

    use Taggable;

    private $command;

    private $resource;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;

    /**
     * @var ResourceRepositoryWrite
     */
    private $resourceRepositoryWrite;


    public function __construct(ResourceRepositoryRead $resourceRepositoryRead, ResourceRepositoryWrite $resourceRepositoryWrite)
    {
        $this->resourceRepositoryRead = $resourceRepositoryRead;
        $this->resourceRepositoryWrite = $resourceRepositoryWrite;
    }


    public function __invoke(UpdateResourceCommand $command)
    {

        $this->initializeCommand($command);

        $this->find($command->getUuid());

        $this->fill();

        $this->update();

        $this->syncTags($this->resource, $command->getTag());

        $this->syncTagsAuthor($this->resource, $command->getAuthor());

        $this->syncTagsEvent($this->resource, $command->getEvent());

        $this->syncTagsTechnology($this->resource, $command->getTechnology());

    }


    private function initializeCommand(UpdateResourceCommand $command)
    {
        $this->command = $command;
    }


    private function find(string $aUuid)
    {
        $this->resource = $this->resourceRepositoryRead->findByUuid($aUuid);
    }


    private function fill()
    {

        $this->resource->title = $this->command->getTitle();
        $this->resource->description = $this->command->getDescription();
        $this->resource->published_at = $this->command->getPublishedAt();
        $this->resource->url = $this->command->getUrl();
        $this->resource->category_id = $this->command->getCategoryId();
        $this->resource->lang_id = $this->command->getLangId();

    }


    private function update()
    {
        $this->resourceRepositoryWrite->save($this->resource);
    }

}