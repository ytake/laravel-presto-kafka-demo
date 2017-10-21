<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Acme\Analysis\Specification\ActiveAnalysisSpecification;
use Acme\Analysis\Usecase\UserAnalysisUsecase;
use App\DataAccess\LogIndex;
use Illuminate\Contracts\View\View;
use Illuminate\View\Factory as ViewFactory;

/**
 * Class AnalyzeAction
 */
final class AnalyzeAction extends Controller
{
    /** @var ActiveAnalysisSpecification */
    private $specification;

    /** @var UserAnalysisUsecase */
    private $usecase;

    /** @var ViewFactory */
    private $view;

    /**
     * AnalyzeAction constructor.
     *
     * @param ActiveAnalysisSpecification $specification
     * @param UserAnalysisUsecase         $usecase
     * @param ViewFactory                 $view
     */
    public function __construct(
        ActiveAnalysisSpecification $specification,
        UserAnalysisUsecase $usecase,
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
        return $this->view->make('analysis', [
            'list' => $this->usecase->run($this->specification),
        ]);
    }
}
