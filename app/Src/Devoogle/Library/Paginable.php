<?php

namespace Devoogle\Src\Devoogle\Library;

use Devoogle\Src\Devoogle\Exceptions\InvalidPageNumberException;

trait Paginable
{

    protected $page = '';

    protected function initializePaginable()
    {

        $this->page = request()->input('page');

        $this->checkPageTypeIsValid();
    }

    protected function checkPageTypeIsValid()
    {

        if ( ! $this->pageExists()) {
            return;
        }

        $this->checkPageIsNumber();

        $this->checkPageNoIsNegative();

    }

    protected function pageExists()
    {
        return ! is_null($this->page);
    }


    protected function checkPageIsNumber()
    {
        if ( ! is_numeric($this->page)) {
            throw new InvalidPageNumberException();
        }
    }

    protected function checkPageNoIsNegative()
    {
        if ($this->page < 0) {
            throw new InvalidPageNumberException();
        }
    }

    protected function checkPageInRange()
    {

        if ( ! $this->pageExists()) {
            return;
        }

        $selectedPage = (int)$this->page;
        $totalPage = $this->resources->total();

        $selectedPageExceedsMaximum = ($selectedPage > $totalPage);

        if ($selectedPageExceedsMaximum) {
            throw new InvalidPageNumberException();
        }

    }


}