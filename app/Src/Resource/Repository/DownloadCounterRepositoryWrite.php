<?php

namespace Devoogle\Src\Resource\Repository;

use Devoogle\Src\Resource\Model\DownloadCounter;

class DownloadCounterRepositoryWrite
{

    public function increment(int $resourceId)
    {
        return DownloadCounter::create([
            'resource_id' => $resourceId
        ]);

    }

}