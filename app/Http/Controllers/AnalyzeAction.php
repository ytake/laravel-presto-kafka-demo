<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Acme\Analysis\Specification\ActiveAnalysisSpecification;
use Acme\Analysis\Usecase\UserAnalysisUsecase;
use App\Http\Responders\HtmlResponder;
use Illuminate\Http\Response;

/**
 * Class AnalyzeAction
 */
final class AnalyzeAction extends Controller
{
    /** @var ActiveAnalysisSpecification */
    private $specification;

    /** @var UserAnalysisUsecase */
    private $usecase;

    /**
     * AnalyzeAction constructor.
     *
     * @param ActiveAnalysisSpecification $specification
     * @param UserAnalysisUsecase         $usecase
     */
    public function __construct(
        ActiveAnalysisSpecification $specification,
        UserAnalysisUsecase $usecase
    ) {
        $this->specification = $specification;
        $this->usecase = $usecase;
    }

    /**
     * @param HtmlResponder $responder
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(HtmlResponder $responder): Response
    {
        $responder->template('analysis');
        return $responder->emit([
            'list' => $this->usecase->run($this->specification),
        ]);
    }
}
