<?php

namespace Devoogle\Src\Social\Handler;

use Devoogle\Src\Social\Command\SocialHandlerCommand;
use Devoogle\Src\Social\Library\InstanceSocialUserFactory;
use Devoogle\Src\Social\Model\Social;
use Devoogle\Src\Social\Repository\SocialRepository;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\User\Repository\CharacterRepositoryRead;
use Devoogle\Src\User\Repository\UserRepository;

class SocialHandler
{

    private $userRepository;

    private $socialRepository;

    private $instanceSocialUserFactory;

    private $command;

    private $socialUser;

    private $user;

    private $loginWithRegister = false;

    /**
     * @var \Devoogle\Src\User\Repository\CharacterRepositoryRead
     */
    private $characterRepositoryRead;

    public function __construct(
        UserRepository $userRepository,
        SocialRepository $socialRepository,
        CharacterRepositoryRead $characterRepositoryRead
    )
    {

        $this->userRepository = $userRepository;
        $this->socialRepository = $socialRepository;

        $this->instanceSocialUserFactory = app(InstanceSocialUserFactory::class);

        $this->characterRepositoryRead = $characterRepositoryRead;
    }


    public function isLoginWithRegister(): bool
    {
        return $this->loginWithRegister;
    }


    public function __invoke(SocialHandlerCommand $command)
    {

        $this->setCommand($command);

        $this->obtainSocialUser();

        $this->findUserByMail();

        if ($this->userNotFound()) {
            $this->obtainUserFromSocial();

            $this->createUserSocial();
        }

        $this->toDoLogin();

    }


    private function setCommand(SocialHandlerCommand $command)
    {
        $this->command = $command;
    }


    private function obtainSocialUser()
    {
        $this->socialUser = $this->instanceSocialUserFactory->instanceUserFromSocialite($this->command->getProvider());
    }


    private function findUserByMail()
    {
        $this->user = $this->userRepository->findByEmail($this->socialUser->email());
    }


    private function userNotFound()
    {
        return is_null($this->user);
    }

    private function obtainUserFromSocial()
    {

        $this->user = $this->obtainUserFromSocialUser();

    }


    private function obtainUserFromSocialUser()
    {
        $socialUserRegistered = $this->socialRepository->findBySocialIdAndProvider($this->socialUser->id(), $this->command->getProvider());

        if ($socialUserRegistered) {
            return $socialUserRegistered->user;
        }
    }

    private function createUserSocial()
    {

        if ($this->userNotFound()) {

            $this->create();

        }

        $this->loginWithRegister = true;

    }


    private function create()
    {

        $this->createUser();

        $this->associateSocialDataToUser();
    }


    private function createUser()
    {

        $this->user = User::create([
            'name' => $this->obtainName(),
            'email' => $this->retrieveEmailOrFake(),
            'password' => bcrypt(str_random(40)),
        ]);

    }

    private function obtainName()
    {

        $character = $this->characterRepositoryRead->random();

        return $character->name;

    }


    private function retrieveEmailOrFake()
    {

        $email = $this->socialUser->email();

        if ( ! $email) {
            $email = 'missing' . str_random(10);
        }

        return $email;
    }


    private function associateSocialDataToUser()
    {
        $socialData = app(Social::class);
        $socialData->social_id = $this->user->id;
        $socialData->provider = $this->command->getProvider();
        $this->user->social()->save($socialData);
    }


    private function toDoLogin()
    {
        auth()->login($this->user, true);
    }


    private function userExists()
    {
        return $this->user instanceof User;
    }
}