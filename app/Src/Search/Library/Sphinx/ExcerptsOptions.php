<?php

namespace Devoogle\Src\Search\Library\Sphinx;

class ExcerptsOptions implements ExcerptsOptionsInterface
{

    public function options(): array
    {
        return [
            'before_match'    => $this->beforeMatch(),
            'after_match'     => $this->afterMatch(),
            'chunk_separator' => $this->chunkSeparator(),
            'limit'           => $this->limit(),
            'around'          => $this->around(),
            'html_strip_mode' => $this->htmlStripMode(),
            'limit_passages'  => $this->limitPassages(),
            'allow_empty'     => $this->allowEmpty()
        ];
    }


    public function beforeMatch(): string
    {
        return config('sphinx.excerpts.before_match');
    }


    public function afterMatch(): string
    {
        return config('sphinx.excerpts.after_match');
    }


    public function chunkSeparator(): string
    {
        return config('sphinx.excerpts.chunk_separator');
    }


    public function limit(): int
    {
        return config('sphinx.excerpts.limit');
    }


    public function around(): int
    {
        return config('sphinx.excerpts.around');
    }


    public function htmlStripMode(): string
    {
        return config('sphinx.excerpts.html_strip_mode');
    }


    public function limitPassages(): int
    {
        return config('sphinx.excerpts.limit_passages');
    }


    public function allowEmpty(): bool
    {
        return config('sphinx.excerpts.allow_empty');
    }
}
