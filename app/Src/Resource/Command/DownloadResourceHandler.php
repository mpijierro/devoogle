<?php

namespace Devoogle\Src\Resource\Command;

use Devoogle\Src\Resource\Job\DownloadVideoToAudio;
use Devoogle\Src\Resource\Library\AudioFile;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\User\Model\User;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Convert and download youtube video in audio format
 *
 * Class DownloadResouceHandler
 * @package Devoogle\Src\Resource\Command
 */
class DownloadResourceHandler
{

    private $resource;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;

    public function __construct(ResourceRepositoryRead $resourceRepositoryRead)
    {
        $this->resourceRepositoryRead = $resourceRepositoryRead;
    }

    public function __invoke(DownloadResourceCommand $command)
    {

        $this->find($command->getSlug());

        $audioFile = app(AudioFile::class, ['resource' => $this->resource]);

        if ($audioFile->exists()) {
            return $audioFile;
        }

        $user = User::find(2);

        DownloadVideoToAudio::dispatch($audioFile, $user)->onQueue('audio');

        return $audioFile;

    }

    private function find(string $slug)
    {
        $this->resource = $this->resourceRepositoryRead->findBySlug($slug);
    }
}