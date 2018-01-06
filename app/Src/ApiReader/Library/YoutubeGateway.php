<?php

namespace Devoogle\Src\ApiReader\Library;


class YoutubeGateway
{

    const VIDEO_URL = 'https://www.youtube.com/watch?v=';

    private $video;

    public function __construct($video)
    {
        $this->video = $video;
    }

    public function title()
    {
        return $this->video->snippet->title;
    }

    public function url()
    {
        return self::VIDEO_URL . $this->videoId();
    }

    public function videoId()
    {
        return $this->video->id->videoId;
    }

    public function description()
    {
        return $this->video->snippet->description;
    }

}