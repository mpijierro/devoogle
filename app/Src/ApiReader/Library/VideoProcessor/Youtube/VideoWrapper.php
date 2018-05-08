<?php

namespace Devoogle\Src\ApiReader\Library\VideoProcessor\Youtube;

use Illuminate\Support\Collection;

class VideoWrapper
{

    const VIDEO_URL = 'https://www.youtube.com/watch?v=';

    private $video;


    public function __construct($video)
    {
        $this->video = $video;

        dd($this->video);
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

    public function obtainTextsForSearch(): Collection
    {

        $textsForTagSearch = collect();

        if ( ! empty($this->title())) {
            $textsForTagSearch->push($this->title());
        }

        if ( ! empty($this->description())) {
            $textsForTagSearch->push($this->description());
        }

    }

}