<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Repository\ResourceRepositoryRead;
use Mulidev\Src\Resource\Repository\ResourceRepositoryWrite;

class UpdateResourceHandler
{

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

        $this->syncTags();

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
        $this->resource->url = $this->command->getUrl();
        $this->resource->category_id = $this->command->getCategoryId();
        $this->resource->lang_id = $this->command->getLangId();

    }

    private function update()
    {
        $this->resourceRepositoryWrite->save($this->resource);
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