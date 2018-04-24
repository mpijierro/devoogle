<?php

namespace Tests;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\User\Model\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function defaultUser()
    {
        return factory(User::class)->create();
    }

}
