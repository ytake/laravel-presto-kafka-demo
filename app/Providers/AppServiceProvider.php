<?php
declare(strict_types=1);

namespace App\Providers;

use App\DataAccess\LogProduce;
use App\DataAccess\RegisterProduce;
use App\Foundation\Consumer\Consumer;
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
                $producer = new Producer($topic['topic'], $topic['brokers'], $topic['options']);
                $producer->setLogger($app['log']);

                return $producer;
            });
        $this->app->when(RegisterProduce::class)
            ->needs(Producer::class)
            ->give(function (Application $app) {
                $kafkaConfig = $app['config']->get('kafka');
                $topic = $kafkaConfig['topics']['fulltext.register'];
                $producer = new Producer($topic['topic'], $topic['brokers'], $topic['options']);
                $producer->setLogger($app['log']);

                return $producer;
            });

        $this->app->bind(ClientSession::class, function (Application $app) {
            $prestoConfig = $app['config']->get('presto');
            $connectionConfig = $prestoConfig['connections']['presto_test'];

            return new ClientSession($connectionConfig['host'], $connectionConfig['catalog']);
        });

        $this->app->singleton(Consumer::class, function (Application $app) {
            $kafkaConfig = $app['config']->get('kafka');
            $consumerConfig = $kafkaConfig['consumer'];

            return new Consumer($consumerConfig['brokers'], $consumerConfig['options']);
        });
    }
}
