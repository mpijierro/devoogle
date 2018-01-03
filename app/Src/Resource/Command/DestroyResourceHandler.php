<?php

namespace Devoogle\Src\Resource\Command;

use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Resource\Repository\ResourceRepositoryWrite;
use Devoogle\Src\Version\Repository\VersionRepositoryWrite;

class DestroyResourceHandler
{

    private $resource;
    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;
    /**
     * @var ResourceRepositoryWrite
     */
    private $resourceRepositoryWrite;
    /**
     * @var VersionRepositoryWrite
     */
    private $versionRepositoryWrite;

    public function __construct(ResourceRepositoryRead $resourceRepositoryRead, ResourceRepositoryWrite $resourceRepositoryWrite, VersionRepositoryWrite $versionRepositoryWrite)
    {

        $this->resourceRepositoryRead = $resourceRepositoryRead;
        $this->resourceRepositoryWrite = $resourceRepositoryWrite;
        $this->versionRepositoryWrite = $versionRepositoryWrite;
    }

    public function __invoke(DestroyResourceCommand $command)
    {

        $this->find($command->getUuid());

        $this->detachTags();

        $this->deleteVersions();

        $this->destroy();

    }

    private function find($uuid)
    {
        $this->resource = $this->resourceRepositoryRead->findByUuid($uuid);

    }

    private function detachTags()
    {

        $tags = $this->resource->tags;

        foreach ($tags as $tag) {
            $this->resource->detachTag($tag);
        }
    }

    private function deleteVersions()
    {

        $this->resource->version()->forceDelete();

    }

    private function destroy()
    {
        $this->resourceRepositoryWrite->destroy($this->resource);
    }

}