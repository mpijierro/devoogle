<?php
namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Resource\Exception\DownloadResourceException;
use Devoogle\Src\Resource\Library\AudioFile;
use Devoogle\Src\Resource\Library\AudioFileInterface;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;

/**
 * Get download audio path
 *
 * Class DownloadResouceManager
 * @package Devoogle\Src\Resource\Query
 */
class DownloadResourceManager
{

    /**
     * @var DownloadResourceQuery
     */
    private $query;

    /**
     * @var Resource
     */
    private $resource;

    /**
     * @var AudioFile
     */
    private $audioFile;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;


    public function __construct(ResourceRepositoryRead $resourceRepositoryRead, AudioFileInterface $audioFile)
    {
        $this->resourceRepositoryRead = $resourceRepositoryRead;
        $this->audioFile = $audioFile;
    }

    public function __invoke(DownloadResourceQuery $command):DownloadResourceView
    {
        $this->initialize($command);

        $this->findResource($this->query->getSlug());

        $this->checkfileExists();

        return new DownloadResourceView($this->audioFile->path($this->resource));
    }

    private function initialize(DownloadResourceQuery $command)
    {
        $this->query = $command;
    }

    private function checkfileExists(): bool
    {

        if ( ! $this->audioFile->exists($this->resource)){
            DownloadResourceException::fileResourceNotFound($this->resource);
        }

        return true;

    }

    private function findResource(string $slug)
    {
        $this->resource = $this->resourceRepositoryRead->findBySlug($slug);
    }

}