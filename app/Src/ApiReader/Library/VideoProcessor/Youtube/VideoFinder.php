<?php

namespace Devoogle\Src\ApiReader\Library\VideoProcessor\Youtube;

use Alaouy\Youtube\Facades\Youtube;
use Carbon\Carbon;
use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;

class VideoFinder
{

    const RESULTS_PER_PAGE = 50;

    //private $years = [2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018];
    private $years = [2017];


    private $num = 0;

    private $videos = [];

    private $pageInfo = [];

    private $publishedAfter;

    private $publishedBefore;

    private $videoChannel;


    public function __construct()
    {
        $this->videos = collect();
    }


    public function find(VideoChannel $videoChannel)
    {
        $this->initialize($videoChannel);

        $this->findByYears();
    }


    public function videos()
    {
        return $this->videos;
    }


    public function num()
    {
        return $this->num;
    }


    private function initialize(VideoChannel $videoChannel)
    {
        $this->num = 0;

        $this->videoChannel = $videoChannel;
    }


    private function findByYears()
    {


        foreach ($this->years as $year) {

            $this->processFirstTrimester($year);

            $this->processSecondTrimester($year);

            $this->processThirdTrimester($year);

            $this->processFourthTrimester($year);
        }

    }


    private function processFirstTrimester($year)
    {

        $this->publishedAfter = Carbon::parse('01-01-'.$year.' 00:00:00')->toRfc3339String();
        $this->publishedBefore = Carbon::parse('31-03-'.$year.' 23:59:59')->toRfc3339String();

        $this->processTrimester();

    }


    private function processSecondTrimester($year)
    {

        $this->publishedAfter = Carbon::parse('01-04-'.$year.' 00:00:00')->toRfc3339String();
        $this->publishedBefore = Carbon::parse('30-06-'.$year.' 23:59:59')->toRfc3339String();

        $this->processTrimester();

    }


    private function processThirdTrimester($year)
    {

        $this->publishedAfter = Carbon::parse('01-07-'.$year.' 00:00:00')->toRfc3339String();
        $this->publishedBefore = Carbon::parse('30-09-'.$year.' 23:59:59')->toRfc3339String();

        $this->processTrimester();

    }


    private function processFourthTrimester($year)
    {

        $this->publishedAfter = Carbon::parse('01-10-'.$year.' 00:00:00')->toRfc3339String();
        $this->publishedBefore = Carbon::parse('31-12-'.$year.' 23:59:59')->toRfc3339String();

        $this->processTrimester();

    }


    private function processTrimester()
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


    private function thereVideos()
    {
        return ! is_bool($this->results());
    }


    private function isContinue()
    {
        if (is_bool($this->results())) {
            return $this->results();
        }

        return true;
    }


    private function obtainParametersForPaginate()
    {
        $pageParameter = $this->obtainPageParameter();

        $paramsDate = $this->obtainLimitInTime();

        return array_merge($pageParameter, $paramsDate);
    }


    private function obtainPageParameter()
    {
        return [
            'type'       => $this->obtainParameter('type'),
            'channelId'  => $this->obtainParameter('channelId'),
            'part'       => implode(', ', $this->obtainParameter('part')),
            'maxResults' => $this->obtainParameter('maxResults'),
            'order'      => $this->obtainParameter('order')
        ];
    }


    private function obtainLimitInTime()
    {
        return [
            'publishedAfter'  => $this->publishedAfter,
            'publishedBefore' => $this->publishedBefore
        ];
    }


    private function wrapVideos(array $videos)
    {

        $this->num += count($videos);

        foreach ($videos as $video) {

            $video->snippet->description = $this->obtainDescriptionComplete($video->id->videoId);

            $videoWrapper = app(VideoWrapper::class, ['video' => $video]);

            $this->videos->push($videoWrapper);

        }
    }


    private function results()
    {
        if (isset($this->pageInfo['results'])) {
            return $this->pageInfo['results'];
        }

        return [];
    }


    private function thereIsNextPage()
    {
        return ( ! is_null($this->pageInfo['info']['nextPageToken']));
    }


    private function obtainNextPageToken()
    {
        return $this->pageInfo['info']['nextPageToken'] ?? null;
    }


    private function obtainParameter($parameter)
    {

        $parameters = $this->obtainParameters();

        return $parameters[$parameter];

    }


    private function obtainParameters()
    {
        return [
            'type'           => 'video',
            'channelId'      => $this->videoChannel->slugId(),
            'resultsPerPage' => self::RESULTS_PER_PAGE,
            'maxResults'     => self::RESULTS_PER_PAGE,
            'order'          => 'date',
            'part'           => ['id', 'snippet'],
            'pageInfo'       => true
        ];
    }

    private function obtainDescriptionComplete(string $videoId)
    {

        $video = Youtube::getVideoInfo($videoId);

        dd(json_encode($video));

        return $video->snippet->description;

    }

}