<?php

namespace Devoogle\Console\Commands;

use Devoogle\Src\ApiReader\Command\CollectWeDevelopersHandler;
use Devoogle\Src\User\Repository\UserRepository;
use Illuminate\Console\Command;

class CollectAudios extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collect:audio {platform}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command search and save audios';

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

        if ($this->collectFromDevelopers()) {
            $handler = app(CollectWeDevelopersHandler::class);
            $handler($user);
        }

    }


    private function obtainUserAdmin()
    {
        return $this->userRepository->findAdmin();
    }


    private function collectFromDevelopers()
    {
        return ($this->argument('platform') == 'wedevelopers');
    }
}
