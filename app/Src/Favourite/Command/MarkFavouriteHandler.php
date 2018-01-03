<?php

namespace Devoogle\Src\Favourite\Command;

use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\User\Repository\UserRepository;

class MarkFavouriteHandler
{

    private $command;

    private $user;

    private $resource;
    /**
     * @var ResourceRepositoryRead
     */
    private $repositoryRead;
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(ResourceRepositoryRead $repositoryRead, UserRepository $userRepository)
    {

        $this->repositoryRead = $repositoryRead;
        $this->userRepository = $userRepository;
    }

    public function __invoke(MarkFavouriteCommand $command)
    {

        $this->initializeCommand($command);

        $this->findResource();

        $this->findUser();

        $this->mark();

    }

    private function initializeCommand(MarkFavouriteCommand $command)
    {
        $this->command = $command;
    }

    private function findResource()
    {
        $this->resource = $this->repositoryRead->findByUuid($this->command->getUuid());
    }

    private function findUser()
    {
        $this->user = $this->userRepository->findByIdOrFail($this->command->getUserId());
    }

    private function mark()
    {
        $this->user->favourite()->attach($this->resource);
    }

}