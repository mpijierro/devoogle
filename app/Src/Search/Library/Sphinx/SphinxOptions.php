<?php

namespace Devoogle\Src\Search\Library\Sphinx;

class SphinxOptions implements SphinxOptionsInterface
{

    public function server ():string{
        return config('sphinx.sphinx.server');
    }

    public function port ():string{
        return config('sphinx.sphinx.port');
    }

    public function offset ():int{
        return config('sphinx.sphinx.offset');
    }

    public function limit ():int{
        return config('sphinx.sphinx.limit');
    }

    public function max ():int{
        return config('sphinx.sphinx.max');
    }

}