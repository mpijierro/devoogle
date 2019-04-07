<?php

namespace Devoogle\Src\Search\Library\Sphinx;

interface SphinxOptionsInterface
{

    public function server(): string;

    public function port(): string;

    public function offset(): int;

    public function limit(): int;

    public function max(): int;
}