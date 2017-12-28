<?php

namespace Mulidev\Src\User\Repository;

use Mulidev\Src\User\Model\User;

class UserRepository
{

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function findByEmail(string $email)
    {
        return $this->user->where('email', $email)->first();
    }


}
