<?php

namespace Devoogle\Src\ApiReader\Library;


use Alaouy\Youtube\Facades\Youtube;
use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;

class YoutubeChannelProcessor
{

    const RESULTS_PER_PAGE = 50;

    private $videoChannel = null;

    private $pageInfo = [];
    /**
     * @var YoutubeVideoProcessor
     */
    private $youtubeVideoProcessor;

    public function __construct(YoutubeVideoProcessor $youtubeVideoProcessor)
    {
        $this->youtubeVideoProcessor = $youtubeVideoProcessor;
    }

    public function __invoke(VideoChannel $videoChannel)
    {

        $this->initializeChannel($videoChannel);

        $this->initializePageInfo();

        $this->initialProcess();

        $this->pagesProcess();
    }

    private function initializeChannel(VideoChannel $videoChannel)
    {
        $this->videoChannel = $videoChannel;
    }

    private function initializePageInfo()
    {
        $this->pageInfo = [];
    }

    private function pagesProcess()
    {

        //$page = 0;
        //$end = false;

        do {

            $this->pageProcess();

            /*
            if ($this->thereIsNextPage()) {
                $this->pageProcess();
                $page++;
            } else {
                $end = true;
            }
            */

            //} while ($page < 3 and $end == false);
        } while ($this->thereIsNextPage());


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

            try {

                $youtubeGateway = app(YoutubeGateway::class, ['video' => $video]);

                ($this->youtubeVideoProcessor)($youtubeGateway);

            } catch (\Exception $e) {

                throw $e;
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