<?php
declare(strict_types=1);

namespace App\Http\Controllers\Fulltext;

use Acme\Blog\Specification\ActiveEntrySpecification;
use Acme\Blog\Usecase\RetrieveEntryUsecase;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory as ViewFactory;

/**
 * Class IndexAction
 */
final class IndexAction extends Controller
{
    /** @var ActiveEntrySpecification */
    private $specification;

    /** @var RetrieveEntryUsecase */
    private $usecase;

    /** @var ViewFactory */
    private $view;

    /**
     * IndexAction constructor.
     *
     * @param ActiveEntrySpecification $specification
     * @param RetrieveEntryUsecase     $usecase
     * @param ViewFactory              $view
     */
    public function __construct(
        ActiveEntrySpecification $specification,
        RetrieveEntryUsecase $usecase,
        ViewFactory $view
    ) {
        $this->specification = $specification;
        $this->usecase = $usecase;
        $this->view = $view;
    }

    /**
     * @return View
     */
    public function __invoke(): View
    {
        return $this->view->make('fulltext.index', [
            'list' => $this->usecase->run($this->specification)
        ]);
    }
}
