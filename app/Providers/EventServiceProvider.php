<?php
declare(strict_types=1);

namespace App\Providers;

use App\Events\Loggable;
use App\Listeners\LoggableHandler;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher as EventDispatcher;

/**
 * Class EventServiceProvider
 */
class EventServiceProvider extends ServiceProvider
{
    public function boot(EventDispatcher $dispatcher)
    {
        $dispatcher->listen(Loggable::class, LoggableHandler::class);
    }
}
