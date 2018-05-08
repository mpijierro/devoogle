<?php

namespace Devoogle\Console\Commands;

use Devoogle\Src\ApiReader\Command\CollectYoutubeHandler;
use Devoogle\Src\User\Repository\UserRepository;
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
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->obtainUserAdmin();

        if ($this->collectFromYoutube()) {
            $handler = app(CollectYoutubeHandler::class);
            $handler($user);
        }

    }

    private function collectFromYoutube()
    {
        return ($this->argument('platform') == 'youtube');
    }

    private function obtainUserAdmin()
    {
        return $this->userRepository->findAdmin();
    }
}
