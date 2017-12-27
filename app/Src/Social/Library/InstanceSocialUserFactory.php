<?php

namespace Mulidev\Src\Social\Library;

use Mulidev\Src\Social\Model\Social;
use Laravel\Socialite\Facades\Socialite;

class InstanceSocialUserFactory
{
    public function instanceUserFromSocialite($provider = '')
    {

        $socialUserObject = $this->obtainSocialUserObject($provider);

        if ($provider == Social::FACEBOOK_PROVIDER) {
            return app(FacebookSocialUser::class, ['socialUserObject' => $socialUserObject]);
        } elseif ($provider == Social::GOOGLE_PROVIDER) {
            return app(GoogleSocialUser::class, ['socialUserObject' => $socialUserObject]);
        }
        throw new \InvalidArgumentException(sprintf("Provider %s not found", $provider));
    }

    private function obtainSocialUserObject($provider)
    {

        $socialUserObject = Socialite::driver($provider)->user();

        $this->checkSocialUserObject($socialUserObject);

        return $socialUserObject;

    }

    private function checkSocialUserObject($socialUserObject)
    {
        if (is_null($socialUserObject)) {
            throw new \Exception('User not logged');
        }
    }
}