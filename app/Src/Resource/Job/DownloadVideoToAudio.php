<?php

namespace Devoogle\Src\Resource\Job;

use Devoogle\Src\Resource\Library\AudioFile;
use Devoogle\Src\Resource\Mail\DownloadAudioExceptionMail;
use Devoogle\Src\Resource\Mail\DownloadAudioMail;
use Devoogle\Src\User\Model\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DownloadVideoToAudio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

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
        $this->downloadVideo();

        $this->sendMailWithDownloadUrl();
    }

    private function downloadVideo()
    {

        $process = new Process($this->command());
        $process->run();

        if ( ! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
    }

    private function command()
    {
        return "youtube-dl --extract-audio --audio-format mp3 -o " . $this->audioFile->path() . " " . $this->audioFile->resource()->url();
    }

    private function sendMailWithDownloadUrl()
    {

        $email = $this->user->email();

        Mail::to($email)->send(new DownloadAudioMail($this->audioFile->resource()));

    }

    public function failed(\Exception $exception)
    {
        Log::error($exception);

        $email = config('devoogle.exception_mail');

        if ( ! empty($email)) {
            Mail::to($email)->send(new DownloadAudioExceptionMail($this->audioFile->resource(), $exception));
        }
    }

}
