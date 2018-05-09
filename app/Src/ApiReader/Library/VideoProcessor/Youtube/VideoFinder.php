<?php

namespace Devoogle\Src\ApiReader\Library\VideoProcessor\Youtube;

use Alaouy\Youtube\Facades\Youtube;
use Carbon\Carbon;
use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;
use Illuminate\Support\Collection;

abstract class VideoFinder
{

    const RESULTS_PER_PAGE = 50;

    protected $num = 0;

    protected $videos = [];

    protected $pageInfo = [];

    protected $publishedAfter;

    protected $publishedBefore;

    protected $videoChannel;

    public function __construct()
    {
        $this->videos = collect();
    }

    public function videos()
    {
        return $this->videos;
    }


    public function num()
    {
        return $this->num;
    }


    protected function initialize(VideoChannel $videoChannel)
    {
        $this->num = 0;

        $this->videoChannel = $videoChannel;
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


    protected function obtainVideos()
    {

        do {

            $continue = true;

            $params = $this->obtainParametersForPaginate();

            $this->pageInfo = Youtube::paginateResults($params, $this->obtainNextPageToken());

            if ($this->thereVideos()) {

                $this->wrapVideos($this->results());

            } else {

                $continue = $this->isContinue();

            }

        } while ($this->thereIsNextPage() and $continue == true);

    }


    protected function obtainParametersForPaginate()
    {
        $pageParameter = $this->obtainPageParameter();

        $paramsDate = $this->obtainLimitInTime();

        return array_merge($pageParameter, $paramsDate);
    }


    protected function obtainPageParameter()
    {
        return [
            'type' => $this->obtainParameter('type'),
            'channelId' => $this->obtainParameter('channelId'),
            'part' => implode(', ', $this->obtainParameter('part')),
            'maxResults' => $this->obtainParameter('maxResults'),
            'order' => $this->obtainParameter('order')
        ];
    }


    protected function obtainLimitInTime()
    {
        return [
            'publishedAfter' => $this->publishedAfter,
            'publishedBefore' => $this->publishedBefore
        ];
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


    protected function obtainParameter($parameter)
    {

        $parameters = $this->obtainParameters();

        return $parameters[$parameter];

    }


    protected function obtainParameters()
    {
        return [
            'type' => 'video',
            'channelId' => $this->videoChannel->slugId(),
            'resultsPerPage' => self::RESULTS_PER_PAGE,
            'maxResults' => self::RESULTS_PER_PAGE,
            'order' => 'date',
            'part' => ['id', 'snippet'],
            'pageInfo' => true
        ];
    }


    protected function obtainFullVideo(VideoWrapper $videoWrapper)
    {

        $video = Youtube::getVideoInfo($videoWrapper->videoId());

        if ($video) {
            $videoWrapper->setFullVideo($video);
        }

    }

}
