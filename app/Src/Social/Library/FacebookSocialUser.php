<?php

namespace Mulidev\Src\Social\Library;

class FacebookSocialUser extends SocialUser
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

        $name = $this->fullName();

        $name = explode(' ', $name);

        return empty($name[0]) ? '' : $name[0];
    }

    private function fullName()
    {
        $user = $this->getField('user');

        return $user['name'];
    }

    public function lastName()
    {

        $name = $this->fullName();

        $name = explode(' ', $name);

        return empty($name[1]) ? '' : $name[1];
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

/*
 *
 * User {#406 ▼
  +token: "EAAcN1ClawvMBAFmnjYqAvN9ZCucAq33SIaf7kEHXZA8GgP9ym32tDUdWTe0e2x0vjUdf2GhNZAZCVf9eZCkeQ2ehlcyDoSOvIovf0UNFDtvapjGjJ7AYFZCsVOaZCMVNRv3JeheuLdbbHV3agUvJ6MZBl9TFTKO ▶"
  +refreshToken: null
  +expiresIn: 5183531
  +id: "1703437316629182"
  +nickname: null
  +name: "Manu Pijierro Sa"
  +email: "gmanute@gmail.com"
  +avatar: "https://graph.facebook.com/v2.9/1703437316629182/picture?type=normal"
  +user: array:6 [▼
    "name" => "Manu Pijierro Sa"
    "email" => "gmanute@gmail.com"
    "gender" => "male"
    "verified" => true
    "link" => "https://www.facebook.com/app_scoped_user_id/1703437316629182/"
    "id" => "1703437316629182"
  ]
  +"avatar_original": "https://graph.facebook.com/v2.9/1703437316629182/picture?width=1920"
  +"profileUrl": "https://www.facebook.com/app_scoped_user_id/1703437316629182/"
}
 *
 */