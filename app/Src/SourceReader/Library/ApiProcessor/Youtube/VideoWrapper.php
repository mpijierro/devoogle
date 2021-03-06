<?php

namespace Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube;

use Carbon\Carbon;
use Devoogle\Src\SourceReader\Library\ResourceWrapper;
use Illuminate\Support\Collection;

/**
 * + Info: https://developers.google.com/youtube/v3/docs/videos?hl=es-419
 *
 * Class VideoWrapper
 * @package Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube
 */
class VideoWrapper extends ResourceWrapper
{

    const VIDEO_URL = 'https://www.youtube.com/watch?v=';
    const PROCESSED_STATUS = 'processed';

    private $video;

    private $fullVideo = '';


    public function __construct($video)
    {
        $this->video = $video;
    }


    public function title(): string
    {
        return $this->video->snippet->title;
    }


    public function url(): string
    {
        return self::VIDEO_URL.$this->videoId();
    }


    public function videoId()
    {
        return $this->video->id->videoId;
    }


    public function description(): string
    {
        if ($this->hasFullVideo()) {
            return $this->fullVideo->snippet->description;
        }

        return $this->video->snippet->description;
    }


    public function setDescription(string $description)
    {
        $this->video->snippet->description = $description;
    }


    public function setFullVideo(\stdClass $fullVideo)
    {
        $this->fullVideo = $fullVideo;
    }


    public function fullVideo()
    {
        if ($this->hasFullVideo()) {
            return $this->fullVideo;
        }

        return new \stdClass();
    }


    public function hasFullVideo()
    {
        return ! empty($this->fullVideo);
    }


    public function hasPublishedDate()
    {
        return isset($this->video->snippet->publishedAt) AND ! empty($this->video->snippet->publishedAt);
    }


    public function publishedAt(): Carbon
    {

        if ($this->hasPublishedDate()) {
            return Carbon::parse($this->video->snippet->publishedAt);
        }

        return Carbon::now();

    }


    public function status()
    {
        return $this->fullVideo->status;
    }


    public function isUploadStatusProcessed()
    {

        return $this->fullVideo->status->uploadStatus == self::PROCESSED_STATUS;
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

        return $textsForTagSearch;

    }
}