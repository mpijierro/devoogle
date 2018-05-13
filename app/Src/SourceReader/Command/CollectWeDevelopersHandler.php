<?php

namespace Devoogle\Src\SourceReader\Command;

use Devoogle\Src\SourceReader\Library\AudioProcessor\WeDevelopers\AudioProcessor;
use Devoogle\Src\User\Model\User;

class CollectWeDevelopersHandler
{

    private $user;

    /**
     * @var AudioProcessor
     */
    private $audioProcessor;


    public function __construct(AudioProcessor $audioProcessor)
    {
        $this->audioProcessor = $audioProcessor;
    }


    public function __invoke(User $user)
    {
        $this->user = $user;

        $this->audioProcessor->processChannel($this->user);
    }

}
