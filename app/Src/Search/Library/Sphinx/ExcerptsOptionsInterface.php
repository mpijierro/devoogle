<?php

namespace Devoogle\Src\Search\Library\Sphinx;

interface ExcerptsOptionsInterface
{
    public function options(): array;

    public function beforeMatch(): string;

    public function afterMatch(): string;

    public function chunkSeparator(): string;

    public function limit(): int;

    public function around(): int;

    public function htmlStripMode(): string;

    public function limitPassages(): int;

    public function allowEmpty(): bool;

}

