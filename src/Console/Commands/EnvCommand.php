<?php

namespace Mrba\LaraHper\Console\Commands;

use Illuminate\Console\Command;

class EnvCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larahper:env';

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
        $extraConfig = $this->laravel['files']->get(__DIR__ . '/../../../.env.example');
        $config = $this->laravel['files']->get(base_path('.env'));

        $this->laravel['files']->put(base_path('.env'), $config . $extraConfig);
        $this->line('配置完成...');
        return 0;
    }
};
