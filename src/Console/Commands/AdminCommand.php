<?php

namespace Mrba\LaraHper\Console\Commands;

use Illuminate\Console\Command;

class AdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larahper:admin {op} {--ability=default}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $command = $this->argument('op');
        if ($command == 'newtoken') {
            $ability = $this->option('ability');
            $this->line('new token -----------');
            $this->line($ability);
        }
        $this->line($command);
        return 0;
    }
}
