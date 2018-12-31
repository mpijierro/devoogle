<?php

namespace Devoogle\Src\Resource\Mail;

use Devoogle\Src\Resource\Model\Resource;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class DownloadAudioMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Resource
     */
    public $resource;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject(trans('resource.actions.download.subject', ['title' => $this->resource->title()]))
            ->view('resource.download_audio_mail');
    }

}
