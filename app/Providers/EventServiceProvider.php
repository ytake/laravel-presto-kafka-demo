<?php
declare(strict_types=1);

namespace App\Providers;

use App\Events\Loggable;
use App\Events\SinkConnect;
use App\Listeners\LoggableHandler;
use App\Listeners\SinkConnectHandler;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;
use Illuminate\Support\ServiceProvider;

/**
 * Class EventServiceProvider
 */
class EventServiceProvider extends ServiceProvider
{
    /**
     * @param EventDispatcher $dispatcher
     */
    public function boot(EventDispatcher $dispatcher)
    {
        $dispatcher->listen(Loggable::class, LoggableHandler::class);
        $dispatcher->listen(SinkConnect::class, SinkConnectHandler::class);
    }
}
