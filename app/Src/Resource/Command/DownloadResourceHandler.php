<?php

namespace Devoogle\Src\Resource\Command;

use Devoogle\Src\Resource\Mail\DownloadAudioMail;
use Devoogle\Src\Resource\Job\DownloadVideoToAudio;
use Devoogle\Src\Resource\Library\AudioFile;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\User\Exception\UserIsNotLoggedInException;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\User\Repository\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Mail;

/**
 * Convert and download youtube video in audio format
 *
 * Class DownloadResouceHandler
 * @package Devoogle\Src\Resource\Command
 */
class DownloadResourceHandler
{

    /**
     * @var DownloadResourceCommand
     */
    private $command;

    /**
     * @var Resource
     */
    private $resource;

    /**
     * @var User
     */
    private $user;

    /**
     * @var AudioFile
     */
    private $audioFile;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(ResourceRepositoryRead $resourceRepositoryRead, UserRepository $userRepository)
    {
        $this->resourceRepositoryRead = $resourceRepositoryRead;
        $this->userRepository = $userRepository;
    }

    public function __invoke(DownloadResourceCommand $command)
    {

        $this->initialize($command);

        if ($this->fileExists()) {
            return $this->audioFile;
        }

        $this->findUser($command->getUserId());

        $this->obtainVideoAndConvert();

        return $this->audioFile;

    }

    private function initialize(DownloadResourceCommand $command)
    {

        $this->command = $command;

        $this->findResource($this->command->getSlug());

        $this->buildAudioFile();
    }

    private function fileExists(): bool
    {

        return $this->audioFile->exists();

    }

    private function obtainVideoAndConvert()
    {
        DownloadVideoToAudio::dispatch($this->audioFile, $this->user)->onQueue('audio');
    }

    private function findResource(string $slug)
    {
        $this->resource = $this->resourceRepositoryRead->findBySlug($slug);
    }

    private function findUser(int $userId)
    {
        try {
            $this->user = $this->userRepository->findByIdOrFail($userId);
        } catch (ModelNotFoundException $exception) {
            throw new UserIsNotLoggedInException();
        }

    }

    private function buildAudioFile()
    {
        $this->audioFile = app(AudioFile::class, ['resource' => $this->resource]);
    }
}