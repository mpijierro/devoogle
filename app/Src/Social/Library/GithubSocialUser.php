<?php

namespace Devoogle\Src\Social\Library;

class GithubSocialUser extends SocialUser
{

    public function __construct($socialUserObject)
    {
        parent::__construct((array)$socialUserObject);
    }

    public function id()
    {
        return $this->getField('id');
    }

    public function username()
    {
        $username = $this->getField('nickname');

        if ($username == null) {
            return str_replace(' ', '', $this->name());
        }

        return $username;
    }

    public function name()
    {
        $user = $this->getField('user');

        return $user['name'];
    }

    public function firstName()
    {

        $user = $this->getField('user');

        return $user['name'];
    }


    public function lastName()
    {

        $user = $this->getField('user');

        return $user['name'];
    }

    public function email()
    {
        return $this->getField('email');
    }

    public function obtainGender()
    {
        $user = $this->getField('user');

        return $user['gender'];
    }
}
