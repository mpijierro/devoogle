<?php

namespace Devoogle\Src\Resource\Job;

use Devoogle\Src\Resource\Library\AudioFile;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DownloadVideoToAudio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(AudioFile $audioFile, User $user)
    {

        $process = new Process($this->command($audioFile));
        $process->run();

        // executes after the command finishes
        if ( ! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        /*
         * 1) check if it is been processed
         *
         * 2) send to email if exception
         * echo $process->getOutput();
         */


    }

    private function command(AudioFile $audioFile)
    {
        return "youtube-dl --extract-audio --audio-format mp3 -o " . $audioFile->path() . " " . $this->resource->url();
    }

}
