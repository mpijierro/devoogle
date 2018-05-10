<?php

namespace Devoogle\Src\ApiReader\Command;

use Devoogle\Src\ApiReader\Library\AudioProcessor\WeDevelopers\AudioProcessor;
use Devoogle\Src\User\Model\User;
use SimpleXMLElement;

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
