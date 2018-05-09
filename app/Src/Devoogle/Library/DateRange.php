<?php

namespace Devoogle\Src\Devoogle\Library;

use Carbon\Carbon;

class DateRange
{

    /**
     * @var Carbon
     */
    private $start;

    /**
     * @var Carbon
     */
    private $end;


    public function __construct(Carbon $start, Carbon $end)
    {
        $this->start = $start;
        $this->end = $end;
    }


    /**
     * @return Carbon
     */
    public function start(): Carbon
    {
        return $this->start;
    }


    /**
     * @return Carbon
     */
    public function end(): Carbon
    {
        return $this->end;
    }

}