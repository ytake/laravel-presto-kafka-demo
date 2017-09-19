<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\Loggable;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class IndexAction
 */
final class IndexAction extends Controller
{
    /**
     * @param Dispatcher $dispatcher
     * @param Request    $request
     *
     * @return View
     */
    public function __invoke(Dispatcher $dispatcher, Request $request): View
    {
        $dispatcher->dispatch(new Loggable($request->getUri()));

        return view('welcome');
    }
}
