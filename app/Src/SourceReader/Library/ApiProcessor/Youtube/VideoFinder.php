<?php

namespace Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube;

use Alaouy\Youtube\Facades\Youtube;
use Carbon\Carbon;
use Devoogle\Src\Devoogle\Library\DateRange;
use Devoogle\Src\SourceReader\Model\YoutubeChannel;

abstract class VideoFinder
{

    protected $num = 0;

    protected $videos = [];

    protected $pageInfo = [];

    protected $publishedAfter;

    protected $publishedBefore;

    protected $videoChannel;

    /**
     * @var SetupSearch
     */
    private $setupSearch;


    public function __construct(SetupSearch $setupSearch)
    {
        $this->videos = collect();
        $this->setupSearch = $setupSearch;
    }


    public function videos()
    {
        return $this->videos;
    }


    public function num()
    {
        return $this->num;
    }


    protected function initialize(YoutubeChannel $videoChannel)
    {
        $this->num = 0;

        $this->videoChannel = $videoChannel;
    }


    protected function obtainVideos()
    {

        do {

            $continue = true;

            $setupSearch = $this->obtainSetupSearch();

            $this->pageInfo = Youtube::paginateResults($setupSearch, $this->obtainNextPageToken());

            if ($this->thereVideos()) {

                $this->wrapVideos($this->results());

            } else {

                $continue = $this->isContinue();

            }

        } while ($this->thereIsNextPage() and $continue == true);

    }


    private function obtainSetupSearch()
    {

        $dateRange = new DateRange(Carbon::parse($this->publishedAfter), Carbon::parse($this->publishedBefore));

        return $this->setupSearch->obtainSetup($this->videoChannel, $dateRange);

    }


    protected function thereVideos()
    {
        return ! is_bool($this->results());
    }


    protected function isContinue()
    {
        if (is_bool($this->results())) {
            return $this->results();
        }

        return true;
    }


    protected function wrapVideos(array $videos)
    {

        $this->num += count($videos);

        foreach ($videos as $video) {

            $videoWrapper = app(VideoWrapper::class, ['video' => $video]);

            $this->obtainFullVideo($videoWrapper);

            $this->videos->push($videoWrapper);

        }
    }


    protected function obtainFullVideo(VideoWrapper $videoWrapper)
    {

        $video = Youtube::getVideoInfo($videoWrapper->videoId());

        if ($video) {
            $videoWrapper->setFullVideo($video);
        }

    }


    protected function results()
    {
        if (isset($this->pageInfo['results'])) {
            return $this->pageInfo['results'];
        }

        return [];
    }


    protected function thereIsNextPage()
    {
        return ( ! is_null($this->pageInfo['info']['nextPageToken']));
    }


    protected function obtainNextPageToken()
    {
        return $this->pageInfo['info']['nextPageToken'] ?? null;
    }

}
