<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Repository\ResourceRepository;

class UpdateResourceHandler
{

    private $command;

    private $resource;

    private $resourceRepository;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
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
        $this->resource = $this->resourceRepository->findByUuid($aUuid);
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
        $this->resourceRepository->save($this->resource);
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