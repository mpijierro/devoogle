<?php

namespace Devoogle\Src\User\Repository;

use Devoogle\Src\User\Model\User;

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


    public function findByIdOrFail(int $id)
    {
        return $this->user->findOrFail($id);
    }

    public function findAdmin()
    {
        return $this->user->where('is_admin', true)->first();
    }


}
