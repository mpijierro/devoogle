<?php

namespace Devoogle\Src\Resource\Command;

use Devoogle\Src\Resource\Exception\DownloadResourceException;
use Devoogle\Src\Resource\Job\DownloadVideoToAudio;
use Devoogle\Src\Resource\Library\AudioFile;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;

/**
 * Throw job to process video and send email with a download link
 *
 * Class SendDownDownloadResourceHandler
 * @package Devoogle\Src\Resource\Command
 */
class SendDownloadResourceHandler
{

    /**
     * @var SendDownloadResourceCommand
     */
    private $command;

    /**
     * @var Resource
     */
    private $resource;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;

    public function __construct(ResourceRepositoryRead $resourceRepositoryRead)
    {
        $this->resourceRepositoryRead = $resourceRepositoryRead;
    }

    public function __invoke(SendDownloadResourceCommand $command)
    {

        $this->initialize($command);

        $this->checkResourceIsYoutubeVideo();

        $this->obtainVideoAndConvert();

    }

    private function initialize(SendDownloadResourceCommand $command)
    {

        $this->command = $command;

        $this->findResource($this->command->getSlug());

    }

    protected function obtainVideoAndConvert()
    {
        DownloadVideoToAudio::dispatch($this->resource, $this->command->getEmail(), app(AudioFile::class))->onQueue('audio');
    }

    protected function findResource(string $slug)
    {
        $this->resource = $this->resourceRepositoryRead->findBySlug($slug);
    }

    protected function checkResourceIsYoutubeVideo()
    {

        if ( ! $this->resource->isFromYoutubeChannel()) {
            DownloadResourceException::resourceNotIsFromYoutubeChannel();
        }

    }

}