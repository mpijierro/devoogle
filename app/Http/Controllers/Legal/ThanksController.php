<?php

namespace Devoogle\Http\Controllers\Legal;

use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\SourceReader\Model\YoutubeChannel;

class ThanksController
{
    public function __invoke()
    {

        $sources = Source::orderBy('name', 'asc')->get();
        view()->share('sources', $sources);

        $channels = YoutubeChannel::orderBy('name', 'asc')->get();
        view()->share('channels', $channels);

        return view('legal.thanks');
    }
}