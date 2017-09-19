<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Usecase\UserAnalysisUsecase;

/**
 * Class AnalyzeAction
 */
final class AnalyzeAction extends Controller
{
    /**
     * @param UserAnalysisUsecase $usecase
     */
    public function __invoke(UserAnalysisUsecase $usecase)
    {
        dd($usecase->run());
    }
}
