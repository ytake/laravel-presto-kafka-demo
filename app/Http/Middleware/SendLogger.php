<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use App\Events\Loggable;
use Illuminate\Http\Request;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * Class SendLogger
 */
final class SendLogger
{
    /** @var Dispatcher */
    private $dispatcher;

    /**
     * SendLogger constructor.
     *
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->dispatcher->dispatch(new Loggable($request->getUri()));

        return $next($request);
    }
}
