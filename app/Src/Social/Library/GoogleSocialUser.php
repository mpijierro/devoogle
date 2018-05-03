<?php

namespace Devoogle\Src\Social\Library;

class GoogleSocialUser extends SocialUser
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

        return $user['displayName'];
    }


    public function firstName()
    {

        $name = $this->obtainNameInfo();

        return $name['givenName'];
    }


    private function obtainNameInfo()
    {
        $user = $this->getField('user');

        return $user['name'];
    }


    public function lastName()
    {

        $name = $this->obtainNameInfo();

        return $name['familyName'];
    }


    public function email()
    {
        return $this->getField('email');
    }

}