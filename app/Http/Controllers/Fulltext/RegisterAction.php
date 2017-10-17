<?php
declare(strict_types=1);

namespace App\Http\Controllers\Fulltext;

use App\DataAccess\RegisterProduce;
use App\Definition\FulltextDefinition;
use App\Http\Controllers\Controller;
use App\Http\Requests\FulltextRequest;
use Illuminate\Contracts\View\View;
use Ramsey\Uuid\Uuid;

/**
 * Class RegisterAction
 */
final class RegisterAction extends Controller
{
    /** @var FulltextRequest */
    private $request;

    /** @var RegisterProduce */
    private $registerProduce;

    /**
     * RegisterAction constructor.
     *
     * @param FulltextRequest $request
     */
    public function __construct(FulltextRequest $request, RegisterProduce $registerProduce)
    {
        $this->request = $request;
        $this->registerProduce = $registerProduce;
    }

    public function __invoke()
    {
        $this->registerProduce->run(
            new FulltextDefinition(Uuid::uuid4()->toString(), "aaaaaaaaa")
        );
    }
}
