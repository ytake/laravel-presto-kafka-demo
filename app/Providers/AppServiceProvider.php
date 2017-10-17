<?php

namespace App\Providers;

use App\Console\InitRedisCommand;
use App\DataAccess\LogProduce;
use App\DataAccess\RegisterProduce;
use App\Foundation\Producer\Producer;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Ytake\PrestoClient\ClientSession;

/**
 * Class AppServiceProvider
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('app.command.init.redis', function (Application $app) {
            return new InitRedisCommand($app['redis']);
        });

        $this->commands([
            'app.command.init.redis',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(LogProduce::class)
            ->needs(Producer::class)
            ->give(function (Application $app) {
                $kafkaConfig = $app['config']->get('kafka');
                $topic = $kafkaConfig['topics']['analyze.action'];

                return new Producer($topic['topic'], $topic['brokers'], $topic['options']);
            });
        $this->app->when(RegisterProduce::class)
            ->needs(Producer::class)
            ->give(function (Application $app) {
                $kafkaConfig = $app['config']->get('kafka');
                $topic = $kafkaConfig['topics']['fulltext.register'];

                return new Producer($topic['topic'], $topic['brokers'], $topic['options']);
            });

        $this->app->bind(ClientSession::class, function (Application $app) {
            $prestoConfig = $app['config']->get('presto');
            $connectionConfig = $prestoConfig['connections']['presto_test'];

            return new ClientSession($connectionConfig['host'], $connectionConfig['catalog']);
        });
    }
}
