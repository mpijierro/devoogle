<?php

namespace Devoogle\Src\Viewed\Command;

use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\User\Repository\UserRepository;

class ToggleViewedHandler
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


    public function __invoke(ToggleViewedCommand $command)
    {

        $this->initializeCommand($command);

        $this->findResource();

        $this->findUser();

        $this->toggle();

    }


    private function initializeCommand(ToggleViewedCommand $command)
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


    private function toggle()
    {
        $this->user->viewed()->toggle([$this->resource->id()]);
    }

}