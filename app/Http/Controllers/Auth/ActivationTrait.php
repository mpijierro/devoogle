<?php

namespace Devoogle\Http\Controllers\Auth;

use Devoogle\Logic\Activation\ActivationRepository;
use Devoogle\Src\User\Model\User;
use Illuminate\Support\Facades\Validator;

trait ActivationTrait
{

    public function initiateEmailActivation(User $user)
    {

        if ( ! config('settings.activation') || ! $this->validateEmail($user)) {

            return true;

        }

        $activationRepostory = new ActivationRepository();
        $activationRepostory->createTokenAndSendEmail($user);

    }

    protected function validateEmail(User $user)
    {

        $validator = Validator::make(['email' => $user->email], ['email' => 'required|email']);

        if ($validator->fails()) {
            return false;
        }

        return true;

    }

}