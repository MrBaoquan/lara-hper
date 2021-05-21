<?php

namespace Mrba\LaraHper\Console\Commands;

use Illuminate\Console\Command;
use Mrba\LaraHper\Facades\LaraHper;

class AdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     *
     * examples
     *  php artisan larahper:admin newtoken --name=wxapi --A=create --A=update
     */
    protected $signature = 'larahper:admin {op} {--name=default} {--A|ability=*}';

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
            $tokenName = $this->option('name');
            $abilities = $this->option('ability');
            $token = LaraHper::Administrator()->createToken($tokenName, $abilities);
            $this->line("Generated new token:");
            $this->line($token->plainTextToken);
        } else if ($command == "cleartoken") {
            if ($this->confirm("Clear all tokens?")) {
                LaraHper::Administrator()->tokens()->delete();
            };
        }
        return 0;
    }
}
