<?php

namespace Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube;

use Carbon\Carbon;
use Devoogle\Src\SourceReader\Model\YoutubeChannel;
use Illuminate\Support\Collection;

class FinderByYears extends VideoFinder
{

    private $years = [];


    public function __construct(SetupSearch $setupSearch)
    {
        parent::__construct($setupSearch);

        $this->loadYears();
    }

    public function find(YoutubeChannel $videoChannel): Collection
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
        $this->publishedAfter = $after;
        $this->publishedBefore = $before;
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


    private function loadYears()
    {
        $this->years = range(2007, date('Y'));
    }
}
