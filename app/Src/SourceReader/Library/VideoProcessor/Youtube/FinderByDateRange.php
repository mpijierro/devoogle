<?php

namespace Devoogle\Src\SourceReader\Library\VideoProcessor\Youtube;

use Devoogle\Src\Devoogle\Library\DateRange;
use Devoogle\Src\SourceReader\VideoChannel\Model\YoutubeChannel;
use Illuminate\Support\Collection;

class FinderByDateRange extends VideoFinder
{

    public function find(YoutubeChannel $videoChannel, DateRange $dateRange): Collection
    {
        $this->initialize($videoChannel);

        $this->findByDateRange($dateRange);

        return $this->videos;
    }


    private function findByDateRange(DateRange $dateRange)
    {
        $this->publishedAfter = $dateRange->start()->toRfc3339String();
        $this->publishedBefore = $dateRange->end()->toRfc3339String();

        $this->obtainVideos();
    }

}
