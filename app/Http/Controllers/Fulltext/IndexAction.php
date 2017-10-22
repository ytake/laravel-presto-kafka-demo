<?php
declare(strict_types=1);

namespace App\Http\Controllers\Fulltext;

use Acme\Blog\Specification\ActiveEntrySpecification;
use Acme\Blog\Usecase\RetrieveEntryUsecase;
use App\Http\Controllers\Controller;
use App\Http\Responders\HtmlResponder;
use Illuminate\Http\Response;

/**
 * Class IndexAction
 */
final class IndexAction extends Controller
{
    /** @var ActiveEntrySpecification */
    private $specification;

    /** @var RetrieveEntryUsecase */
    private $usecase;

    /**
     * IndexAction constructor.
     *
     * @param ActiveEntrySpecification $specification
     * @param RetrieveEntryUsecase     $usecase
     */
    public function __construct(
        ActiveEntrySpecification $specification,
        RetrieveEntryUsecase $usecase
    ) {
        $this->specification = $specification;
        $this->usecase = $usecase;
    }

    /**
     * @param HtmlResponder $responder
     *
     * @return Response
     */
    public function __invoke(HtmlResponder $responder): Response
    {
        $responder->template('fulltext.index');

        return $responder->emit([
            'list' => $this->usecase->run($this->specification),
        ]);
    }
}
