<?php

namespace Tests\Unit\Mock;

use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Resource\Library\AudioFileInterface;

class AudioFileMock implements AudioFileInterface
{

    public function path(Resource $resource): string
    {
        return '/var/www/temp';
    }

    public function exists(Resource $resource): bool
    {
        return true;
    }
}