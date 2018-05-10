<?php

namespace Devoogle\Src\ApiReader\Library\VideoProcessor\Youtube;

use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;
use Devoogle\Src\Devoogle\Library\DateRange;

class SetupSearch
{

    const RESULTS_PER_PAGE = 50;

    private $videoChannel;

    private $dateRange;


    public function obtainSetup(VideoChannel $videoChannel, DateRange $dateRange): array
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
            'type'       => 'video',
            'channelId'  => $this->videoChannel->slugId(),
            'part'       => implode(', ', ['id', 'snippet']),
            'maxResults' => self::RESULTS_PER_PAGE,
            'order'      => 'date'
        ];
    }


    private function filterByDateRange()
    {
        return [
            'publishedAfter'  => $this->dateRange->start(),
            'publishedBefore' => $this->dateRange->end()
        ];
    }
}