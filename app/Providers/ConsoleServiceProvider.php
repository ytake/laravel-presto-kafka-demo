<?php
declare(strict_types=1);

namespace App\Providers;

use App\Console\ConsumerCommand;
use App\Console\InitRedisCommand;
use App\DataAccess\LoggableConsume;
use App\Foundation\Consumer\Consumer;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * Class ConsoleServiceProvider
 */
class ConsoleServiceProvider extends ServiceProvider
{
    /** @var bool */
    protected $defer = true;

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
        $this->app->bind('app.command.kafka.consumer', function (Application $app) {
            return new ConsumerCommand(
                $app->make(Consumer::class),
                $app->make(LoggableConsume::class),
                'analyze.action'
            );
        });
        $this->commands([
            'app.command.init.redis',
            'app.command.kafka.consumer',
        ]);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            'app.command.init.redis',
            'app.command.kafka.consumer',
        ];
    }
}
