<?php

namespace Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube;

use Devoogle\Src\Devoogle\Library\DateRange;
use Devoogle\Src\SourceReader\Model\YoutubeChannel;

class SetupSearch
{

    const RESULTS_PER_PAGE = 50;

    private $videoChannel;

    private $dateRange;


    public function obtainSetup(YoutubeChannel $videoChannel, DateRange $dateRange): array
    {

        $this->videoChannel = $videoChannel;

        $this->dateRange = $dateRange;

        $pagination = $this->setupPagination();

        $filter = $this->filterByDateRange();

        return array_merge($pagination, $filter);

    }


    protected function setupPagination()
    {
        return [
            'type'           => 'video',
            'channelId'      => $this->videoChannel->slugId(),
            'part'           => implode(', ', ['id', 'snippet']),
            'resultsPerPage' => self::RESULTS_PER_PAGE,
            'maxResults'     => self::RESULTS_PER_PAGE,
            'order'          => 'date',
            'pageInfo'       => true
        ];
    }


    private function filterByDateRange()
    {
        return [
            'publishedAfter'  => $this->dateRange->start()->toRfc3339String(),
            'publishedBefore' => $this->dateRange->end()->toRfc3339String()
        ];
    }
}