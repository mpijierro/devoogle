<?php

namespace Devoogle\Src\ApiReader\Library;


use Alaouy\Youtube\Facades\Youtube;
use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;

class YoutubeChannelProcessor
{

    const RESULTS_PER_PAGE = 50;

    private $videoChannel = null;

    private $pageInfo = [];


    public function __invoke(VideoChannel $videoChannel)
    {

        $this->initializeChannel($videoChannel);

        $this->initializePageInfo();

        $this->processChannel();
    }

    private function initializeChannel(VideoChannel $videoChannel)
    {
        $this->videoChannel = $videoChannel;
    }

    private function initializePageInfo()
    {
        $this->pageInfo = [];
    }

    private function processChannel()
    {

        $this->initialProcess();

        $page = 0;
        $end = false;

        do {

            if ($this->thereIsNextPage()) {
                $this->pageProcess();
                $page++;
            } else {
                $end = true;
            }

        } while ($page < 2 and $end == false);


    }

    private function initialProcess()
    {
        $this->pageInfo = Youtube::listChannelVideos($this->obtainParameter('channelId'), $this->obtainParameter('resultsPerPage'),
            $this->obtainParameter('order'), $this->obtainParameter('part'), $this->obtainParameter('pageInfo'));

        $this->processVideos($this->results());
    }

    private function obtainParameter($parameter)
    {

        $parameters = $this->obtainParameters();

        return $parameters[$parameter];

    }

    private function obtainParameters()
    {
        return [
            'type' => 'video',
            'channelId' => $this->videoChannel->slugId(),
            'resultsPerPage' => self::RESULTS_PER_PAGE,
            'maxResults' => self::RESULTS_PER_PAGE,
            'order' => null,
            'part' => ['id', 'snippet'],
            'pageInfo' => true
        ];
    }

    private function processVideos(array $videos)
    {

        foreach ($videos as $video) {

            echo "\r\nvideo: " . $video->snippet->title;
            continue;


            try {

                $youtubeGateway = app(YoutubeGateway::class, ['video' => $video]);

                ($this->youtubeProcessor)($youtubeGateway);

            } catch (\Exception $e) {

                continue;

            }
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

    private function pageProcess()
    {

        $params = $this->obtainParametersForPaginate();

        $this->pageInfo = Youtube::paginateResults($params, $this->obtainNextPageToken());

        if (is_bool($this->results())) {
            return $this->results();
        }

        $this->processVideos($this->results());
    }

    private function obtainParametersForPaginate()
    {
        $params = array(
            'type' => $this->obtainParameter('type'),
            'channelId' => $this->obtainParameter('channelId'),
            'part' => implode(', ', $this->obtainParameter('part')),
            'maxResults' => $this->obtainParameter('maxResults'),
        );

        if ( ! empty($this->obtainParameter('order'))) {
            $params['order'] = $this->obtainParameter('order');
        }

        return $params;
    }

    private function obtainNextPageToken()
    {
        return $this->pageInfo['info']['nextPageToken'];
    }


}