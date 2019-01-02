<?php

namespace Devoogle\Src\Resource\Mail;

use Devoogle\Src\Resource\Model\Resource;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class DownloadAudioExceptionMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Resource
     */
    public $resource;

    /**
     * @var \Exception
     */
    public $exception;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Resource $resource, \Exception $exception)
    {
        $this->resource = $resource;
        $this->exception = $exception;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(trans('resource.actions.download.subject_download_exception', ['title' => $this->resource->title()]))
            ->view('resource.download_audio_exception_mail');
    }

}
