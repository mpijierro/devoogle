<?php

namespace Devoogle\Src\ApiReader\Library\VideoProcessor\Youtube;

use Carbon\Carbon;
use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;
use Illuminate\Support\Collection;

class FinderByYears extends VideoFinder
{
    //private $years = [2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018];
    private $years = [2018];


    public function find(VideoChannel $videoChannel): Collection
    {
        $this->initialize($videoChannel);

        $this->findByYears();

        return $this->videos;
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

        $this->setDateRangePublished(Carbon::parse('01-01-'.$year.' 00:00:00'), Carbon::parse('31-03-'.$year.' 23:59:59'));

        $this->obtainVideos();

    }


    private function setDateRangePublished(Carbon $after, Carbon $before)
    {
        $this->publishedAfter = $after->toRfc3339String();
        $this->publishedBefore = $before->toRfc3339String();
    }


    private function processSecondTrimester($year)
    {

        $this->setDateRangePublished(Carbon::parse('01-04-'.$year.' 00:00:00'), Carbon::parse('30-06-'.$year.' 23:59:59'));

        $this->obtainVideos();

    }


    private function processThirdTrimester($year)
    {

        $this->setDateRangePublished(Carbon::parse('01-07-'.$year.' 00:00:00'), Carbon::parse('30-09-'.$year.' 23:59:59'));

        $this->obtainVideos();

    }


    private function processFourthTrimester($year)
    {
        $this->setDateRangePublished(Carbon::parse('01-10-'.$year.' 00:00:00'), Carbon::parse('31-12-'.$year.' 23:59:59'));

        $this->obtainVideos();

    }

}
