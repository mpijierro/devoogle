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

    public function obtainGender()
    {
        $user = $this->getField('user');

        return $user['gender'];
    }
}

/*
 *
 * User {#404 ▼
  +token: "ya29.GltIBHb__ooeJyfjtKZItRtRb-nHCxPkPFGNFk7cxYMJ9BnzR7Kh62IlflGTgkTzwSL2zzV5VuRfOFpizul-8hyhcZTGAr2E8CrJAXqjmOOrVrFLjZCXFe64q3K2"
  +refreshToken: null
  +expiresIn: 3600
  +id: "112373686024629079789"
  +nickname: null
  +name: "Manuel Pijierro Sa"
  +email: "mpijierro@gmail.com"
  +avatar: "https://lh3.googleusercontent.com/-EV-uHdhx8dE/AAAAAAAAAAI/AAAAAAAAArc/cQ3UwI3Y4R8/photo.jpg?sz=50"
  +user: array:15 [▼
    "kind" => "plus#person"
    "etag" => ""Sh4n9u6EtD24TM0RmWv7jTXojqc/6hGTjgBQ-bLKdTJ67YclDDl1dEk""
    "gender" => "male"
    "emails" => array:1 [▼
      0 => array:2 [▼
        "value" => "mpijierro@gmail.com"
        "type" => "account"
      ]
    ]
    "objectType" => "person"
    "id" => "112373686024629079789"
    "displayName" => "Manuel Pijierro Sa"
    "name" => array:2 [▼
      "familyName" => "Pijierro Sa"
      "givenName" => "Manuel"
    ]
    "url" => "https://plus.google.com/112373686024629079789"
    "image" => array:2 [▼
      "url" => "https://lh3.googleusercontent.com/-EV-uHdhx8dE/AAAAAAAAAAI/AAAAAAAAArc/cQ3UwI3Y4R8/photo.jpg?sz=50"
      "isDefault" => false
    ]
    "isPlusUser" => true
    "language" => "es"
    "circledByCount" => 43
    "verified" => false
    "cover" => array:3 [▼
      "layout" => "banner"
      "coverPhoto" => array:3 [▼
        "url" => "https://lh3.googleusercontent.com/wYlOP8wk_Ax9htPpzsYDCDrpq8z2PiPfZ59AeE77Wg9IAo8k5InYI8Lxeg8VSKDBhSKN4es=s630-fcrop64=1,000042ccfbeeffff"
        "height" => 705
        "width" => 940
      ]
      "coverInfo" => array:2 [▼
        "topImageOffset" => 0
        "leftImageOffset" => 0
      ]
    ]
  ]
  +"avatar_original": "https://lh3.googleusercontent.com/-EV-uHdhx8dE/AAAAAAAAAAI/AAAAAAAAArc/cQ3UwI3Y4R8/photo.jpg"
}
}
 *
 */