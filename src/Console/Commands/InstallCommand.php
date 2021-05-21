<?php

namespace Mrba\LaraHper\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larahper:install';

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
        // horizon 资源发布
        $this->call('horizon:install');

        // laravel-admin 安装
        $this->call('admin:install');
        $this->call('telescope:install');

        // 迁移数据库 sanctum
        $this->call('migrate');

        $userModel = config('larahper.database.users_model');

        if ($userModel::count() == 0) {
            $this->call('db:seed', ['--class' => \Mrba\LaraHper\Database\Seeders\LaraHperSeeder::class]);
        }
        return 0;
    }
}
