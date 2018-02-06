<?php

namespace Devoogle\Http\Controllers\Legal;


class PrivacyPolicyController
{

    public function __invoke()
    {
        return view('legal.privacy_policy');
    }

}