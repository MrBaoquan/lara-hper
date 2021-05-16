<?php

namespace Mrba\LaraHper\Console\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larahper:publish';

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

    protected $publishes = [
        \Mrba\LaraHper\LaraStartServiceProvider::class,
        \Encore\Admin\AdminServiceProvider::class,
        \Laravel\Sanctum\SanctumServiceProvider::class,
        \Overtrue\LaravelWeChat\ServiceProvider::class,
        \Spatie\Backup\BackupServiceProvider::class,
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('build command executed...');

        foreach ($this->publishes as $provider) {
            $this->call('vendor:publish', [
                '--provider' => $provider,
            ]);
        }

        return 0;
    }
}
