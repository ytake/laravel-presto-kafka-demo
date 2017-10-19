<?php
declare(strict_types=1);

namespace App\Http\Controllers\Fulltext;

use App\DataAccess\RegisterProduce;
use App\Definition\FulltextDefinition;
use App\Http\Controllers\Controller;
use App\Http\Requests\FulltextRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Ramsey\Uuid\Uuid;

/**
 * Class RegisterAction
 */
final class RegisterAction extends Controller
{
    /** @var RegisterProduce */
    private $registerProduce;

    /** @var Redirector */
    private $redirector;

    /**
     * RegisterAction constructor.
     *
     * @param RegisterProduce $registerProduce
     * @param Redirector      $redirector
     */
    public function __construct(RegisterProduce $registerProduce, Redirector $redirector)
    {
        $this->registerProduce = $registerProduce;
        $this->redirector = $redirector;
    }

    /**
     * @param FulltextRequest $request
     *
     * @return RedirectResponse
     */
    public function __invoke(FulltextRequest $request): RedirectResponse
    {
        $this->registerProduce->run(
            new FulltextDefinition(Uuid::uuid4()->toString(), $request->get('fulltext'))
        );

        return $this->redirector->route('fulltext.index');
    }
}
