<?php

namespace Devoogle\Src\ApiReader\Library\VideoProcessor\Youtube;

use Alaouy\Youtube\Facades\Youtube;
use Carbon\Carbon;
use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;
use Devoogle\Src\Devoogle\Library\DateRange;
use Illuminate\Support\Collection;

class FinderNew extends VideoFinder
{

    public function find(VideoChannel $videoChannel, DateRange $dateRange): Collection
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
