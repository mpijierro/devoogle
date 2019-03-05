<?php

namespace Devoogle\Src\Devoogle\ComposerView;

use Devoogle\Src\Resource\Library\AudioFile;
use Illuminate\View\View;

class AudioFileComposer
{

    /**
     * @var AudioFile
     */
    private $audioFile;

    public function __construct(AudioFile $audioFile)
    {
        $this->audioFile = $audioFile;
    }

    public function compose(View $view)
    {

        $view->with('audioFile', $this->audioFile);

    }

}