<?php

namespace Mulidev\Src\Social\Handler;

use Mulidev\Src\Social\Library\InstanceSocialUserFactory;
use Mulidev\Src\Social\Repository\SocialRepository;
use Mulidev\Src\Social\Command\SocialHandlerCommand;
use Mulidev\Src\User\Model\User;
use Mulidev\Src\User\Repository\UserRepository;
use Mulidev\Src\Social\Model\Social;

class SocialHandler
{

    private $userRepository;

    private $socialRepository;

    private $instanceSocialUserFactory;

    private $command;

    private $socialUser;

    private $user;

    private $loginWithRegister = false;

    public function __construct(UserRepository $userRepository, SocialRepository $socialRepository)
    {

        $this->userRepository = $userRepository;
        $this->socialRepository = $socialRepository;

        $this->instanceSocialUserFactory = app(InstanceSocialUserFactory::class);

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
            $this->obtainUser();
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

    private function obtainUser()
    {

        $this->user = $this->obtainUserFromSocialUser();

        if ($this->userNotFound()) {

            $this->create();

        }

        $this->loginWithRegister = true;

    }

    private function obtainUserFromSocialUser()
    {
        $socialUserRegistered = $this->socialRepository->findBySocialIdAndProvider($this->socialUser->id(), $this->command->getProvider());

        if ($socialUserRegistered) {
            return $socialUserRegistered->user;
        }
    }

    private function create()
    {

        $this->createUser();

        $this->associateSocialDataToUser();
    }

    private function createUser()
    {

        $this->user = User::create([
            'name' => $this->socialUser->firstName() . ' ' . $this->socialUser->lastName(),
            'email' => $this->retrieveEmailOrFake(),
            'password' => bcrypt(str_random(40)),
        ]);

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