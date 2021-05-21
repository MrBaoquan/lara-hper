<?php

namespace Mrba\LaraHper;

use Illuminate\Support\ServiceProvider;

class LaraHperServiceProvider extends ServiceProvider
{

    // 路由中间件注册
    protected $routeMiddleware = [
        'wechat.oauth' => \Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate::class,
        'wechat.mock' => Middleware\MockWechatOAuth::class,
        'proxy.wechat.oauth' => Middleware\ProxyWechatOAuth::class,
    ];

    // 命令注册
    protected $commands = [
        Console\Commands\AdminCommand::class,
        Console\Commands\PublishCommand::class,
        Console\Commands\InstallCommand::class,
        Console\Commands\EnvCommand::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands($this->commands);
        $this->registerMiddleware();

        $this->app->singleton('LaraHper', function ($app) {
            return new \Mrba\LaraHper\LaraHper();
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        $this->registerPublishing();
    }

    // 资源发布
    protected function registerPublishing()
    {
        $this->publishes([
            __DIR__ . '/../config/larahper.php' => config_path('larahper.php'),
        ]);

        $this->publishes([__DIR__ . '/../database/migrations' => database_path('migrations')]);
    }

    // 中间件注册
    protected function registerMiddleware()
    {
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }
    }
}
