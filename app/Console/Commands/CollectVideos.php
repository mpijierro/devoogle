<?php

namespace Devoogle\Console\Commands;

use Devoogle\Src\ApiReader\Command\CollectYoutubeHandler;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CollectVideos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collect:video {platform}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command search and save new Youtube vídeos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        DB::beginTransaction();

        if ($this->collectFromYoutube()) {
            $handler = app(CollectYoutubeHandler::class);
            $handler();
        }

        DB::rollback();

    }

    private function collectFromYoutube()
    {
        return ($this->argument('platform') == 'youtube');
    }
}
