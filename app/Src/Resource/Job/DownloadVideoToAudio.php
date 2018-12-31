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
     * @var AudioFile
     */
    private $audioFile;
    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(AudioFile $audioFile, User $user)
    {
        $this->audioFile = $audioFile;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $process = new Process($this->command());
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
         *
         * 3) send email with link
         */


    }

    private function command()
    {
        return "youtube-dl --extract-audio --audio-format mp3 -o " . $this->audioFile->path() . " " . $this->audioFile->resource()->url();
    }

}
