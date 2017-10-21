<?php
declare(strict_types=1);

namespace App\Http\Controllers\Fulltext;

use App\Events\SinkConnect;
use App\Http\Controllers\Controller;
use App\Http\Requests\FulltextRequest;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class RegisterAction
 */
final class RegisterAction extends Controller
{
    /** @var Dispatcher */
    private $dispatcher;

    /** @var Redirector */
    private $redirector;

    /**
     * RegisterAction constructor.
     *
     * @param Dispatcher $dispatcher
     * @param Redirector $redirector
     */
    public function __construct(Dispatcher $dispatcher, Redirector $redirector)
    {
        $this->dispatcher = $dispatcher;
        $this->redirector = $redirector;
    }

    /**
     * @param FulltextRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(FulltextRequest $request): RedirectResponse
    {
        // 登録処理後に実行されるevent
        $this->dispatcher->dispatch(
            new SinkConnect(strval($request->get('fulltext')))
        );

        return $this->redirector->route('fulltext.index');
    }
}
