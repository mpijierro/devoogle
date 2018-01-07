<?php

namespace Devoogle\Src\ApiReader\Library;


use Alaouy\Youtube\Facades\Youtube;
use Carbon\Carbon;
use Devoogle\Src\ApiReader\Exceptions\ResourceExistsException;
use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;

class YoutubeChannelProcessor
{

    const RESULTS_PER_PAGE = 50;

    private $videoChannel = null;

    private $pageInfo = [];

    private $years = [2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018];

    /**
     * @var YoutubeVideoProcessor
     */
    private $youtubeVideoProcessor;

    private $publishedAfter;

    private $publishedBefore;

    private $num;

    public function __construct(YoutubeVideoProcessor $youtubeVideoProcessor)
    {
        $this->youtubeVideoProcessor = $youtubeVideoProcessor;
    }

    public function __invoke(VideoChannel $videoChannel)
    {

        $this->initializeChannel($videoChannel);

        $this->initializePageInfo();

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

        foreach ($this->years as $year) {

            $this->num = 0;

            $this->processFirstTrimester($year);

            $this->processSecondTrimester($year);

            $this->processThirdTrimester($year);

            $this->processFourthTrimester($year);

            echo "\r\n num: " . $year . ' - ' . $this->num;

        }
    }

    private function processFirstTrimester($year)
    {

        $this->publishedAfter = Carbon::parse('01-01-' . $year . ' 00:00:00')->toRfc3339String();
        $this->publishedBefore = Carbon::parse('31-03-' . $year . ' 23:59:59')->toRfc3339String();

        $this->process();

    }

    private function processSecondTrimester($year)
    {

        $this->publishedAfter = Carbon::parse('01-04-' . $year . ' 00:00:00')->toRfc3339String();
        $this->publishedBefore = Carbon::parse('30-06-' . $year . ' 23:59:59')->toRfc3339String();

        $this->process();

    }

    private function processThirdTrimester($year)
    {

        $this->publishedAfter = Carbon::parse('01-07-' . $year . ' 00:00:00')->toRfc3339String();
        $this->publishedBefore = Carbon::parse('30-09-' . $year . ' 23:59:59')->toRfc3339String();

        $this->process();

    }

    private function processFourthTrimester($year)
    {

        $this->publishedAfter = Carbon::parse('01-10-' . $year . ' 00:00:00')->toRfc3339String();
        $this->publishedBefore = Carbon::parse('31-12-' . $year . ' 23:59:59')->toRfc3339String();

        $this->process();

    }


    private function process()
    {

        do {

            $end = $this->pageProcess();

        } while ($this->thereIsNextPage() and $end == true);

    }


    private function pageProcess()
    {

        $params = $this->obtainParametersForPaginate();

        $this->pageInfo = Youtube::paginateResults($params, $this->obtainNextPageToken());

        if (is_bool($this->results())) {
            return $this->results();
        }

        $this->processVideos($this->results());

        return true;
    }

    private function obtainParametersForPaginate()
    {
        $paramsPage = array(
            'type' => $this->obtainParameter('type'),
            'channelId' => $this->obtainParameter('channelId'),
            'part' => implode(', ', $this->obtainParameter('part')),
            'maxResults' => $this->obtainParameter('maxResults'),
            'order' => $this->obtainParameter('order')
        );

        $paramsDate = $this->obtainLimitInTime();

        return array_merge($paramsPage, $paramsDate);
    }

    private function obtainLimitInTime()
    {
        return [
            'publishedAfter' => $this->publishedAfter,
            'publishedBefore' => $this->publishedBefore
        ];
    }

    private function processVideos(array $videos)
    {

        $this->num += count($videos);

        foreach ($videos as $video) {

            //echo "\r\nvideo: " . $video->snippet->title . ' - ' . $video->snippet->publishedAt;

            try {

                $youtubeGateway = app(YoutubeGateway::class, ['video' => $video]);

                ($this->youtubeVideoProcessor)($youtubeGateway);
            } catch (ResourceExistsException $e) {
                continue;

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
            'type' => 'video',
            'channelId' => $this->videoChannel->slugId(),
            'resultsPerPage' => self::RESULTS_PER_PAGE,
            'maxResults' => self::RESULTS_PER_PAGE,
            'order' => 'date',
            'part' => ['id', 'snippet'],
            'pageInfo' => true
        ];
    }

}