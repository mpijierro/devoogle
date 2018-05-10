<?php

namespace Devoogle\Src\ApiReader\Library\AudioProcessor\WeDevelopers;

use Devoogle\Src\User\Model\User;
use SimpleXMLElement;

class AudioProcessor
{

    const RSS_URL = 'http://wedevelopers.com/feed/podcast/';

    private $rssContent;

    private $user;


    public function processChannel(User $user)
    {

        $this->user = $user;

        $this->obtainContentFromRss();

        $this->processRss();

    }


    private function obtainContentFromRss()
    {

        $content = file_get_contents(self::RSS_URL);

        $this->rssContent = new SimpleXmlElement($content);

    }


    private function processRss()
    {

        foreach ($this->rssContent->channel->item as $item) {

            $wrapper = new AudioWrapper($item);

            //process wrapper

        }

    }

}