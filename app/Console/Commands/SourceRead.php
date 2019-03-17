<?php

namespace Devoogle\Console\Commands;

use Devoogle\Src\SourceReader\Command\SourceReadHandler;
use Illuminate\Console\Command;

class SourceRead extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devoogle:source-read';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read resource data sources';


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
        $handler = app(SourceReadHandler::class);
        $handler();
    }

}
