<?php

namespace Devoogle\Src\Social\Library;

class TwitterSocialUser extends SocialUser
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
        return $this->getField('name');
    }

    public function firstName()
    {
        return $this->getField('name');
    }

    public function lastName()
    {
        return $this->getField('user');
    }

    public function email()
    {
        return $this->getField('email');
    }

}
